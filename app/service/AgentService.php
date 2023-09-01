<?php

namespace app\service;

use app\enum\AgentAccountDaysLogType;
use app\enum\QueueKey;
use app\model\abstract\QueryFilter;
use app\model\Agent;
use app\model\Config;
use Exception;
use support\Db;
use support\exception\TipsException;
use Webman\RedisQueue\Redis;

class AgentService extends BaseService
{
    public $model = 'app\model\Agent';

    public function getResourceList(QueryFilter $filter, $request, array $with = []): mixed
    {
        $data = parent::getResourceList($filter, $request, $with);

        $data['list'] = array_map(function ($item) {
            $data = Db::table('agent_shop_' . $item->id)->selectRaw('count(1) as total,  COUNT(IF(CURRENT_TIMESTAMP >= expiry_time,1,null)) as expire_num, COUNT(IF(CURRENT_TIMESTAMP < expiry_time,1,null)) as effective_num')->first();
            $item->total = $data->total;
            $item->expire_num = $data->expire_num;
            $item->effective_num = $data->effective_num;
            return $item;
        }, $data['list']);

        return $data;
    }


    /**
     * @param mixed $login_name
     * @return void
     * @throws TipsException
     */
    public function checkLoginNameUniqueOrThrow(mixed $login_name): void
    {
        $id = Agent::query()->where('login_name', $login_name)->value('id');

        if ($id) {
            $this->throw('登录账号重复');
        }
    }

    public function setWalletAddress(mixed $agent_id): Agent
    {
        /**
         * @var Agent $agent
         */
        $agent = Agent::query()->findOrFail($agent_id);

        if ($agent->wallet_address) {
            return $agent;
        }

        $usedWalletAddress = Agent::query()->pluck('wallet_address')->toArray();
        $usedWalletAddress = \array_filter($usedWalletAddress);

        $data = Config::query()->where('key', 'wallet_address')->value('value');
        $data = \json_decode($data, true);
        $totalWalletAddress = \array_column($data, 'address');
        $data = \array_column($data, null, 'address');

        $result = \array_diff($totalWalletAddress, $usedWalletAddress);

        $result = \array_values($result);

        if (empty($result)) {
            $this->throw('钱包地址已使用完,请稍后正在充值');
        }


        $walletAddress = $result[0];

        $agent->wallet_address = $walletAddress;
        $agent->wallet_address_img = $data[$walletAddress]['image'];
        $agent->save();

        Redis::send(QueueKey::CANCEL_AGENT_WALLET_ADDRESS->value, ['id' => $agent_id], 60 * 20);

        return $agent;
    }

    /**
     * 新加天数
     *
     * @param $id
     * @param mixed $days
     * @return void
     */
    public function updateAccountDays($id, mixed $days): void
    {
        /**
         * @var Agent $agent
         */
        $agent = Agent::query()->find($id);
        $agent->account_days += $days;
        $agent->save();

        AgentAccountDaysLogService::instance()->createOne($agent, $days, AgentAccountDaysLogType::ADMIN_CHARGE, 0, []);
    }


}

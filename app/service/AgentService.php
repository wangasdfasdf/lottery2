<?php

namespace app\service;

use app\enum\QueueKey;
use app\model\Agent;
use app\model\Config;
use Exception;
use support\Db;
use support\exception\TipsException;
use Webman\RedisQueue\Redis;

class AgentService extends BaseService
{
    public $model = 'app\model\Agent';

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

        Redis::send(QueueKey::CANCEL_AGENT_WALLET_ADDRESS->value, ['id' => $agent_id], 60*20);

        return $agent;
    }


}

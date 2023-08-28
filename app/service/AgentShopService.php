<?php

namespace app\service;

use app\enum\QueueKey;
use app\model\AgentConfig;
use app\model\AgentShop;
use support\exception\TipsException;
use Webman\RedisQueue\Redis;

class AgentShopService extends BaseService
{
    public $model = 'app\model\AgentShop';

    /**
     * @throws TipsException
     */
    public function checkLoginNameUniqueOrThrow(mixed $login_name): void
    {
        $id = AgentShop::query()->where('login_name', $login_name)->value('id');

        if ($id) {
            $this->throw('登录账号重复');
        }
    }

    /**
     * @throws TipsException
     */
    public function setWalletAddress(mixed $shop_id): AgentShop
    {

        /**
         * @var AgentShop $shop
         */
        $shop = AgentShop::query()->findOrFail($shop_id);

        if ($shop->wallet_address) {
            return $shop;
        }

        $usedWalletAddress = AgentShop::query()->pluck('wallet_address')->toArray();

        $usedWalletAddress = \array_filter($usedWalletAddress);

        $data = AgentConfig::query()->where('key', 'wallet_address')->value('value');

        if (empty($data)){
            $this->throw('请联系管理员设置钱包地址');
        }

        $data = \json_decode($data, true);
        $totalWalletAddress = \array_column($data, 'address');
        $data = \array_column($data, null, 'address');

        $result = \array_diff($totalWalletAddress, $usedWalletAddress);

        $result = \array_values($result);

        if (empty($result)) {
            $this->throw('钱包地址已使用完,请稍后正在充值');
        }


        $walletAddress = $result[0];

        $shop->wallet_address = $walletAddress;
        $shop->wallet_address_img = $data[$walletAddress]['image'];
        $shop->save();

        Redis::send(QueueKey::CANCEL_AGENT_SHOP_WALLET_ADDRESS->value, ['id' => $shop_id, 'table' => $shop->getTable()], 60*20);

        return $shop;

    }

}

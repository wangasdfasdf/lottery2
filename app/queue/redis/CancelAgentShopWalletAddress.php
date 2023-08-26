<?php

namespace app\queue\redis;

use app\enum\QueueKey;
use app\model\Agent;
use app\model\AgentShop;
use support\Db;
use Webman\RedisQueue\Consumer;

class CancelAgentShopWalletAddress implements Consumer
{

    public $queue = QueueKey::CANCEL_AGENT_SHOP_WALLET_ADDRESS;

    public function consume($data): void
    {
        $shop_id = $data['id'];
        $table = $data['table'];

        DB::table($table)->where('id', $shop_id)->update(['wallet_address' => '', 'wallet_address_img' => '']);
    }
}
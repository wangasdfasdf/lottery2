<?php

namespace app\queue\redis;

use app\enum\QueueKey;
use app\model\Agent;
use Webman\RedisQueue\Consumer;

class CancelAgentWalletAddress implements Consumer
{

    public $queue = QueueKey::CANCEL_AGENT_WALLET_ADDRESS;

    public function consume($data)
    {
        $agentId = $data['id'];

        /**
         * @var Agent $agent
         */
        $agent = Agent::query()->find($agentId);
        if ($agent) {
            $agent->wallet_address = '';
            $agent->wallet_address_img = '';
            $agent->save();
        }
    }
}
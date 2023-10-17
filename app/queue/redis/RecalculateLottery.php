<?php

namespace app\queue\redis;

use app\enum\QueueKey;
use app\middleware\traits\SetSuffix;
use app\model\Agent;
use app\model\AgentOrder;
use app\service\AgentOrderService;
use Webman\RedisQueue\Consumer;

class RecalculateLottery implements Consumer
{
    use SetSuffix;

    // 要消费的队列名
    public $queue = QueueKey::RECALCULATE_LOTTERY;

    // 连接名，对应 plugin/webman/redis-queue/redis.php 里的连接`
    public $connection = 'default';

    // 消费
    public function consume($data)
    {
        $type = $data['type'];

        $ids = Agent::query()->pluck('id');

        foreach ($ids as $id) {
            $this->setSuffix($id);

            if ($type == 'bd') {
                $orders = AgentOrder::query()->where('type', 'bjdc')
                    ->whereJsonContains('detail->award_period', $data['issue'])
                    ->whereJsonContains('detail->matchno', $data['issue_num'])
                    ->get();

                foreach ($orders as $order) {
                    AgentOrderService::instance()->runOrderIsWinning($order);
                }
            }

            if ($type == 'jczq') {
                $orders = AgentOrder::query()->where('type', 'jczq')
                    ->whereJsonContains('detail->match_ids', $data['match_id'])
                    ->get();

                foreach ($orders as $order) {
                    AgentOrderService::instance()->runOrderIsWinning($order);
                }
            }


        }
    }
}

<?php

namespace app\service;

use app\enum\AgentAccountDaysLogType;
use app\enum\AgentShopExpiryTimeLogType;
use app\model\AgentShop;
use app\model\AgentShopExpiryTimeLog;

class AgentShopExpiryTimeLogService extends BaseService
{
    public $model = 'app\model\AgentShopExpiryTimeLog';

    public function createOne(AgentShop $shop, float $days, $start_time, AgentShopExpiryTimeLogType $type, array $other): void
    {
        if (empty($days)) {
            return;
        }

        AgentShopExpiryTimeLog::query()->create([
            'shop_id' => $shop->id,
            'days' => $days,
            'start_expiry_time' => $start_time,
            'end_expiry_time' => $shop->expiry_time,
            'type' => $type,
            'other' => $other
        ]);
    }
}

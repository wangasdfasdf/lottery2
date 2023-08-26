<?php

namespace app\service;

use app\enum\AgentAccountDaysLogType;
use app\model\Agent;
use app\model\AgentAccountDaysLog;

class AgentAccountDaysLogService extends BaseService
{
    public $model = 'app\model\AgentAccountDaysLog';

    public function createOne(Agent $agent, float $days, AgentAccountDaysLogType $type, array $other): void
    {
        if (empty($days)) {
            return;
        }

        AgentAccountDaysLog::query()->create([
            'agent_id' => $agent->id,
            'days' => $days,
            'start_days' => $agent->account_days - $days,
            'end_days' => $agent->account_days,
            'type' => $type,
            'other' => $other
        ]);
    }
}

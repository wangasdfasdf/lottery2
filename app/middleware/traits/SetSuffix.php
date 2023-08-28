<?php

namespace app\middleware\traits;

use app\model\AgentConfig;
use app\model\AgentFeedback;
use app\model\AgentOrder;
use app\model\AgentShop;
use app\model\AgentShopExpiryTimeLog;
use app\model\AgentShopWalletPaymentLog;

trait SetSuffix
{

    public function setSuffix(int $agent_id): void
    {
        AgentShop::setTableSuffix($agent_id);
        AgentOrder::setTableSuffix($agent_id);
        AgentConfig::setTableSuffix($agent_id);
        AgentFeedback::setTableSuffix($agent_id);
        AgentShopExpiryTimeLog::setTableSuffix($agent_id);
        AgentShopWalletPaymentLog::setTableSuffix($agent_id);
    }
}
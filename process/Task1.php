<?php

namespace process;

use app\service\AgentOrderService;
use app\service\AgentShopWalletPaymentLogService;
use app\service\AgentWalletPaymentLogService;
use app\service\LotteryBdResultService;
use app\service\LotteryBdSfResultService;
use app\service\LotteryJcResultService;
use app\service\LotteryJcService;
use app\service\LotteryPlsResultService;
use app\service\LotteryPlwResultService;
use support\Log;
use Workerman\Crontab\Crontab;

class Task1
{
    public function onWorkerStart(): void
    {
        new Crontab("0 * * * * *", function () {
            //计算是否中奖
            AgentOrderService::instance()->calculate();
        });
    }
}
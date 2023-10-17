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

class Task2
{
    public function onWorkerStart(): void
    {
        new Crontab("* 30-59 11-22 * * *", function () {
            //获取竞彩历史数据
            LotteryJcService::instance()->history();
        });

    }
}
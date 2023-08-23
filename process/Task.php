<?php

namespace process;

use app\service\LotteryBdResultService;
use app\service\LotteryBdSfResultService;
use app\service\LotteryJcResultService;
use app\service\LotteryPlsResultService;
use app\service\LotteryPlwResultService;
use Workerman\Crontab\Crontab;

class Task
{
    public function onWorkerStart(): void
    {
        new Crontab('0 */10 * * * *', function () {
            LotteryBdResultService::instance()->capture();
            LotteryBdSfResultService::instance()->capture();
            LotteryJcResultService::instance()->capture();
        });

        new Crontab('3 */10 21,22 * * *', function () {
            LotteryPlsResultService::instance()->capture();
            LotteryPlwResultService::instance()->capture();
        });
    }
}
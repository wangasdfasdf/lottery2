<?php

namespace process;

use app\service\LotteryBdResultService;
use Workerman\Crontab\Crontab;

class Task
{
    public function onWorkerStart(): void
    {
        new Crontab('0 */10 * * * *', function () {
            LotteryBdResultService::instance()->capture();
        });
    }
}
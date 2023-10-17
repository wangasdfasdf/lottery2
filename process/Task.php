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

class Task
{
    public function onWorkerStart(): void
    {
//        new Crontab('0 */10 * * * *', function () {
//            //获取北单赛果
//            LotteryBdResultService::instance()->capture();
//
//            //获取北单胜负赛果
//            LotteryBdSfResultService::instance()->capture();
//            //获取竞彩赛果
//            LotteryJcResultService::instance()->capture();
//
//        });

        new Crontab('3 */10 22,23 * * *', function () {
            //获取排列3赛果
            LotteryPlsResultService::instance()->capture();
            //获取排列5赛果
            LotteryPlwResultService::instance()->capture();
        });

//        new Crontab("0 * * * * *", function () {
//            //获取代理充值结果
//            AgentWalletPaymentLogService::instance()->capture();
//        });

//        new Crontab("* 30-59 11-22 * * *", function () {
//            //获取竞彩历史数据
//            LotteryJcService::instance()->history();
//        });

        new Crontab("0 30 * * * *", function () {
            //获取取消比赛的数据
            LotteryJcService::instance()->syncCancelLottery();
        });

//        new Crontab("0 * * * * *", function () {
//            //抓取代理充值
//            AgentShopWalletPaymentLogService::instance()->capture();
//        });

//        new Crontab("0 * * * * *", function () {
//            //计算是否中奖
//            AgentOrderService::instance()->calculate();
//        });
    }
}
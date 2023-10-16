<?php

namespace app\command;

use app\enum\QueueKey;
use app\middleware\traits\SetSuffix;
use app\model\Agent;
use app\model\AgentOrder;
use app\model\AgentShop;
use app\service\AgentOrderService;
use app\service\AgentService;
use app\service\AgentShopWalletPaymentLogService;
use app\service\AgentWalletPaymentLogService;
use app\service\LotteryBdResultService;
use app\service\LotteryBdSfResultService;
use app\service\LotteryJcResultService;
use app\service\LotteryJcService;
use app\service\LotteryPlsResultService;
use app\service\LotteryPlwResultService;
use app\service\OssService;
use app\service\RasService;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use support\Db;
use support\Log;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Webman\RedisQueue\Redis;


class Tests extends Command
{
    use SetSuffix;

    protected static $defaultName = 'tests';
    protected static $defaultDescription = 'Tests';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('name', InputArgument::OPTIONAL, 'Name description');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

//        LotteryJcService::instance()->history();
//
//        dd(1);
//        $this->setSuffix(5);;
//
//
//        $order = AgentOrder::query()->whereJsonContains('detail->award_period', '23093')->whereJsonContains('detail->matchno', 95)->get();
//
//        dd($order->pluck('id'));
//
//        dd(1);
//        /**
//         * @var AgentShop $shop
//         */
//        $shop = AgentShop::query()->first();
//
//        dd($shop->expiry_time, $shop->expiry_time->diff(now())->days);

//        $f = 3.555;
//
//        dd(format_jc_amount($f));
//        //获取北单赛果

//        Log::info("LotteryJcResultService", ['time' => now()->format('Y-m-d H:i:s')]);
//
//        dd(1);
//        LotteryJcService::instance()->history();
        dd(1);
        AgentOrderService::instance()->calculate();
        return self::SUCCESS;
    }

}

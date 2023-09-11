<?php

namespace app\command;

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
use support\Db;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;


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
        $path1 = "/home/wwwroot/linux-client-package/attach/core.dat";
        file_put_contents($path1, '123456');
        $command = 'cd /home/wwwroot/linux-client-package && node build/builder.js';
        exec($command, $output);

        dd($output);


        OssService::instance()->put($object, $content);

        return self::SUCCESS;
    }

}

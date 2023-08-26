<?php

namespace app\command;

use app\model\AgentShop;
use app\service\AgentService;
use app\service\LotteryBdResultService;
use app\service\LotteryBdSfResultService;
use app\service\LotteryJcResultService;
use app\service\LotteryPlsResultService;
use app\service\LotteryPlwResultService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;


class Tests extends Command
{
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
        LotteryBdResultService::instance()->capture();
        LotteryBdSfResultService::instance()->capture();
        LotteryJcResultService::instance()->capture();
        LotteryPlsResultService::instance()->capture();
        LotteryPlwResultService::instance()->capture();
        return self::SUCCESS;
    }

}
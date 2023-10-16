<?php

namespace app\command;

use app\service\LotteryBdResultService;
use app\service\LotteryBdSfResultService;
use app\service\LotteryJcResultService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;


class LotteryResultByNMSJ extends Command
{
    protected static $defaultName = 'lottery:result:by:nmsj';
    protected static $defaultDescription = 'LotteryResultByNMSJ';

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
        $name = $input->getArgument('name');

        LotteryBdResultService::instance()->capture();
//        //获取北单胜负赛果
        LotteryBdSfResultService::instance()->capture();

//        //获取竞彩赛果
        LotteryJcResultService::instance()->capture();

        $output->writeln('success');
        return self::SUCCESS;
    }

}

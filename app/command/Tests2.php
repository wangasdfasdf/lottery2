<?php

namespace app\command;

use app\middleware\traits\SetSuffix;
use app\model\AgentOrder;
use app\model\AgentShop;
use app\service\AgentOrderService;
use app\service\AgentService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;


class Tests2 extends Command
{
    use SetSuffix;
    protected static $defaultName = 'tests2';
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
        AgentShop::setTableSuffix(5);

        /**
         * @var AgentOrder $order
         */
        $order = AgentOrder::query()->find(557144);

        dd(1);
        AgentOrderService::instance()->calculateBjdc($order);

        return self::SUCCESS;
    }

}

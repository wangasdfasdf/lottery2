<?php

namespace app\command;

use app\model\AgentShop;
use app\service\AgentService;
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
        AgentShop::setTableSuffix(1);

        for ($i = 0; $i < 10; $i++) {
            $model = AgentShop::query()->first();
            $output->writeln($model->id);
            sleep(1);
        }


        return self::SUCCESS;
    }

}

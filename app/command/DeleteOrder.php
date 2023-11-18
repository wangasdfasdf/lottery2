<?php

namespace app\command;

use app\middleware\traits\SetSuffix;
use app\model\Agent;
use app\model\AgentOrder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;


class DeleteOrder extends Command
{
    use SetSuffix;

    protected static $defaultName = 'DeleteOrder';
    protected static $defaultDescription = 'DeleteOrder';

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
        $agentIds = Agent::query()->pluck('id');

        foreach ($agentIds as $id) {
            $this->setSuffix($id);

            AgentOrder::query()->where('created_at', '<', now()->subDays(8)->format('Y-m-d H:i:s'))->forceDelete();
        }

        $output->writeln('Hello DeleteOrder');
        return self::SUCCESS;
    }

}

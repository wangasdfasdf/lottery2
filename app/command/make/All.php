<?php

namespace app\command\make;

use app\command\make\traits\Make;
use app\command\make\traits\Output;
use app\command\make\traits\Table;
use Illuminate\Support\Str;
use support\Db;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class All extends Command
{
    use  Table, Make, Output;

    protected static $defaultName = 'make:all';
    protected static $defaultDescription = 'create all';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('table', InputArgument::OPTIONAL, 'Name description');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = $input->getArgument('table');

        $db = self::getDB();


        $arr = [
            'php webman make:controller ' . $table,
            'php webman make:model ' . $table,
            'php webman make:filter ' . $table,
            'php webman make:service ' . $table,
        ];

        foreach ($arr as $cmd) {
            exec($cmd, $result);
        }

        $output->writeln($result);

        return self::SUCCESS;
    }
}

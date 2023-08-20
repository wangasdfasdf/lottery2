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


class Controller extends Command
{
    use  Table, Make, Output;

    protected static $defaultName = 'make:controller';
    protected static $defaultDescription = 'create controller';

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

        self::getDB();

        $model = Str::studly($table);

        $savePath = (app_path("controller" . DIRECTORY_SEPARATOR . "{$model}Controller.php"));

        [$result, $message] = $this->checkFile($savePath);

        if (!$result) {
            $this->error($output, $message);
            return self::FAILURE;
        }

        $result = $this->hasTable($table);

        if (!$result) {
            $this->error($output, "$table not exist");
            return self::FAILURE;
        }

        $file = file_get_contents(base_path('stubs/Controller.stub'));

        $file = strtr($file, [
            '{{Model}}' => $model,
        ]);


        [$result, $message] = $this->saveFile($savePath, $file);

        if ($result) {
            $this->info($output, $message);
        } else {
            $this->error($output, $message);
        }
        return self::SUCCESS;
    }


}

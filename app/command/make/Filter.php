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


class Filter extends Command
{
    use  Table, Make, Output;

    protected static $defaultName = 'make:filter';
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

        $db = self::getDB();

        $model = Str::studly($table);

        $savePath = (app_path("model" . DIRECTORY_SEPARATOR ."filter".DIRECTORY_SEPARATOR . "{$model}Filter.php"));

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

        $file = file_get_contents(base_path('stubs/Filter.stub'));


        $arr = DB::select('SELECT * FROM information_schema.columns WHERE table_schema=? AND TABLE_NAME=?', [$db, $table]);

        $file = strtr($file, [
            '{{Model}}'  => $model,
            '{{method}}' => $this->getMethod($arr),
        ]);


        [$result, $message] = $this->saveFile($savePath, $file);

        if ($result) {
            $this->info($output, $message);
        } else {
            $this->error($output, $message);
        }
        return self::SUCCESS;
    }

    /**
     * 获取模型注释
     *
     * @param array $columns
     * @return string
     */
    public function getMethod(array $columns)
    {
        $template = <<<TPL
    /**
     * 过滤{comment}
     *
     * @param \${method_name}
     * @return mixed
     */
    public function {method_name}(\${method_name})
    {
        return \$this->builder->where('{column}', \${method_name});
    }


TPL;

        return collect($columns)->transform(function ($column) {
            return [
                'method_name' => Str::camel(data_get($column, 'COLUMN_NAME')),
                'column'      => data_get($column, 'COLUMN_NAME'),
                'comment'     => data_get($column, 'COLUMN_COMMENT'),
            ];
        })->transform(function ($column) use ($template) {
            return strtr($template, [
                '{column}'      => $column['column'],
                '{comment}'     => $column['comment'],
                '{method_name}' => $column['method_name'],
            ]);
        })->implode(PHP_EOL);
    }
}

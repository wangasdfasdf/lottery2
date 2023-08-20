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


class Model extends Command
{
    use  Table, Make, Output;

    protected static $defaultName = 'make:model';
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

        $savePath = (app_path("model" . DIRECTORY_SEPARATOR . "{$model}.php"));

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
        $arr = DB::select('SELECT * FROM information_schema.columns WHERE table_schema=? AND TABLE_NAME=?', [$db, $table]);

        $file = file_get_contents(base_path('stubs/Model.stub'));

        $file = strtr($file, [
            '{{Model}}' => $model,
            '{{property}}' => $this->getProperty($arr),
            '{{table}}' => $table,
//            '{{dates}}' => $this->getDattes($arr),
            '{{fillable}}' => $this->getFillable($arr),
            '{{casts}}' => $this->getCasts($arr),
        ]);;


        [$result, $message] = $this->saveFile($savePath, $file);

        if ($result) {
            $this->info($output, $message);
        } else {
            $this->error($output, $message);
        }
        return self::SUCCESS;
    }

    /**
     * 获取模型的 fillable
     *
     * @param array $columns
     * @return string
     */
    public function getFillable(array $columns)
    {
        $template = <<<TPL
        '{column}', //{comment}
TPL;

        return collect($columns)->transform(function ($column) {
            return [
                'column' => data_get($column, 'COLUMN_NAME'),
                'comment' => data_get($column, 'COLUMN_COMMENT'),
            ];
        })->transform(function ($column) use ($template) {
            return strtr($template, [
                '{column}' => $column['column'],
                '{comment}' => $column['comment'],
            ]);
        })->implode(PHP_EOL);
    }

    /**
     * 获取模型注释
     *
     * @param array $columns
     * @return string
     */
    public function getProperty(array $columns)
    {
        $template = <<<TPL
 * @property {type} {name}
TPL;

        return collect($columns)->transform(function ($column) {
            return [
                'type' => data_get($column, 'DATA_TYPE'),
                'name' => data_get($column, 'COLUMN_NAME'),
            ];
        })->transform(function ($column) use ($template) {
            return strtr($template, [
                '{type}' => $this->convertType($column['type']),
                '{name}' => '$' . $column['name'],
            ]);
        })->implode(PHP_EOL);
    }

    /**
     * 获取日期转换字段
     *
     * @param array $columns
     * @return string
     */
    public function getDattes(array $columns)
    {
        $template = <<<TPL
         '{column}',
TPL;

        return collect($columns)->transform(function ($column) {

            if ($this->convertType(data_get($column, 'DATA_TYPE')) == 'Carbon') {
                return [
                    'name' => data_get($column, 'COLUMN_NAME'),
                ];
            }
        })->filter()->transform(function ($column) use ($template) {
            return strtr($template, [
                '{column}' => $column['name'],
            ]);
        })->implode(PHP_EOL);
    }

    public function getCasts(array $columns)
    {
        $template = <<<TPL
         '{column}' => '{type}',
TPL;
        return collect($columns)->transform(function ($column) {

            if (in_array($this->convertType(data_get($column, 'DATA_TYPE')), ['array', 'Carbon'])) {
                return [
                    'name' => data_get($column, 'COLUMN_NAME'),
                    'DATA_TYPE' => data_get($column, 'DATA_TYPE'),
                ];
            }
        })->filter()->transform(function ($column) use ($template) {

            return match ($column['DATA_TYPE']) {
                'timestamp', 'datetime' => strtr($template, [
                    '{column}' => $column['name'],
                    '{type}' => 'datetime:Y-m-d H:i:s',
                ]),
                'json' => strtr($template, [
                    '{column}' => $column['name'],
                    '{type}' => 'array',
                ])
            };
        })->implode(PHP_EOL);
    }

    /**
     * 文件类型转换
     *
     * @param string $type
     */
    public function convertType(string $type)
    {
        $type = strtoupper($type);

        return match ($type) {
            'CHAR', 'VARCHAR', 'TINYBLOB', 'TINYTEXT', 'BLOB', 'TEXT', 'MEDIUMBLOB', 'MEDIUMTEXT', 'LONGBLOB', 'LONGTEXT' => 'string',
            'DATE', 'TIME', 'YEAR', 'DATETIME', 'TIMESTAMP' => 'Carbon',
            'TINYINT', 'SMALLINT', 'MEDIUMINT', 'INT', 'INTEGER', 'BIGINT' => 'int',
            'FLOAT', 'DOUBLE', 'DECIMAL' => 'float',
            'JSON' => 'array',
            default => 'string',
        };
    }
}

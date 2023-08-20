<?php

namespace app\model\traits;

use support\Db;

trait Suffix
{
    private bool $has_table = false;
    // 表后缀
    private static string $table_suffix = '';

    public function __construct(array $attributes = [])
    {
        $this->table .= '_'.self::$table_suffix;

        if (!$this->has_table) {

            $sql = sprintf("SHOW TABLES LIKE '%s'", $this->table);

            $result = Db::select($sql);

            if (empty($result)) {
                $this->createTable(self::$table_suffix);
            }

            $this->has_table = true;
        }

        parent::__construct($attributes);
    }

    /**
     * 设置表后缀
     */
    public static function setTableSuffix(int $uid): string
    {
        self::$table_suffix = $uid;
        return static::class;
    }
}
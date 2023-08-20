<?php

namespace app\command\make\traits;


use Illuminate\Support\Facades\Schema;
use support\Db;

trait Table
{
    /**
     * 获取数据库名称
     *
     * @return string
     */
    public static function getDB(): string
    {
        return DB::connection()->getDatabaseName();
    }

    /**
     * 判断表是否存在
     *
     * @param string $name
     * @return bool
     */
    public function hasTable(string $name): bool
    {
        $sql = sprintf("SHOW TABLES LIKE '%s'", $name);
        $result = Db::select($sql);

        return  !empty($result);
    }

}
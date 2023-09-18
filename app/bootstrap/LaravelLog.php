<?php

namespace app\bootstrap;

use Illuminate\Support\Str;
use support\Db;
use support\Log;
use Webman\Bootstrap;
use Workerman\Worker;

class LaravelLog implements Bootstrap
{

    public static function start(?Worker $worker)
    {
        Db::listen(function ($query) {
            $sql = $query->sql;
            $bindings = [];
            if ($query->bindings) {
                foreach ($query->bindings as $v) {
                    if (is_numeric($v)) {
                        $bindings[] = $v;
                    } else {
                        $bindings[] = '"' . strval($v) . '"';
                    }
                }
            }
            $execute = Str::replaceArray('?', $bindings, $sql);
            Log::info('sql', ['SQL ' . $execute]);
        });
    }
}
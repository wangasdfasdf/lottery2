<?php
namespace app\service;


use app\model\Config;
use support\Model;

class ConfigService extends BaseService
{
    public $model = 'app\model\Config';

    /**
     * 获取配置
     *
     * @param string $key
     * @return object|null
     */
    public function getField(string $key): object|null
    {
        return Config::query()->where('key', $key)->first();
    }
}

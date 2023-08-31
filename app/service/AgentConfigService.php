<?php
namespace app\service;

use app\model\AgentConfig;
use app\model\Config;

class AgentConfigService extends BaseService
{
    public $model = 'app\model\AgentConfig';

    public function getField(string $key): object|null
    {
        return AgentConfig::query()->where('key', $key)->first();
    }
}

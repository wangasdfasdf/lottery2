<?php

namespace app\service;

use app\model\Agent;
use Exception;
use support\Db;
use support\exception\TipsException;

class AgentService extends BaseService
{
    public $model = 'app\model\Agent';

    /**
     * @param mixed $login_name
     * @return void
     * @throws TipsException
     */
    public function checkLoginNameUniqueOrThrow(mixed $login_name): void
    {
        $id = Agent::query()->where('login_name', $login_name)->value('id');

        if ($id) {
            $this->throw('登录账号重复');
        }
    }



}

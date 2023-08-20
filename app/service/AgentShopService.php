<?php
namespace app\service;

use app\model\AgentShop;

class AgentShopService extends BaseService
{
    public $model = 'app\model\AgentShop';

    public function checkLoginNameUniqueOrThrow(mixed $login_name)
    {
        $id = AgentShop::query()->where('login_name', $login_name)->value('id');

        if ($id) {
            $this->throw('登录账号重复');
        }
    }

}

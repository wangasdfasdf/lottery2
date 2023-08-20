<?php

namespace app\service;

use app\model\AdminUser;
use support\exception\TipsException;

class AdminUserService extends BaseService
{
    public $model = 'app\model\AdminUser';

    /**
     * 判断登录账号是否重复
     *
     * @param string $login_name
     * @return void
     * @throws TipsException
     */
    public function checkLoginNameUniqueOrThrow(string $login_name): void
    {
        $id = AdminUser::query()->where('login_name', $login_name)->value('id');

        if ($id) {
            $this->throw('登录账号重复');
        }
    }
}

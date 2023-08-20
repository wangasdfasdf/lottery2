<?php

namespace app\service;

use app\model\AdminUser;
use app\traits\Token;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use support\exception\TipsException;


class AdminUserAuthService extends BaseService
{
    use Token;


    /**
     * 登录
     *
     * @param string $LoginName
     * @param string $password
     * @return Model|AdminUser|Builder|null
     * @throws TipsException
     */
    public function login(string $LoginName, string $password): Model|AdminUser|Builder|null
    {
        /**
         * @var AdminUser $admin
         */
        $admin = AdminUser::query()->where('login_name', $LoginName)->first();

        if (empty($admin)) {
            $this->throw('账号错误');
        }

        if (!passwordVerify($password, $admin->password)) {
            $this->throw('密码错误');
        }


        $admin->token = $this->getToken($admin);
        $admin->save();

        return $admin;
    }


}

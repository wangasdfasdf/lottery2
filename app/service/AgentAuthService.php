<?php

namespace app\service;

use app\enum\StatusEnum;
use app\model\AdminUser;
use app\model\Agent;
use app\traits\Token;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use support\exception\TipsException;


class AgentAuthService extends BaseService
{
    use Token;

    /**
     * 登录
     *
     * @param string $LoginName
     * @param string $password
     * @return Model|Agent|Builder|null
     * @throws TipsException
     */
    public function login(string $LoginName, string $password): Model|Agent|Builder|null
    {
        /**
         * @var Agent $agent
         */
        $agent = Agent::query()->where('login_name', $LoginName)->first();

        if (empty($agent)) {
            $this->throw('账号错误');
        }

        if (!passwordVerify($password, $agent->password)) {
            $this->throw('密码错误');
        }

        if ($agent->status == StatusEnum::DISABLE) {
            $this->throw('管理员已禁用');
        }

        $agent->token = $this->getToken($agent);
        $agent->save();

        return $agent;
    }


}

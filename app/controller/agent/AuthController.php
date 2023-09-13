<?php

namespace app\controller\agent;


use app\controller\Controller;
use app\service\AgentAuthService;
use app\service\AgentService;
use Respect\Validation\Validator;
use support\exception\TipsException;
use support\Request;
use support\Response;

class AuthController extends Controller
{
    /**
     * @throws TipsException
     */
    public function login(Request $request): Response
    {
        $data = $request->all();

        Validator::input($data, [
            'password' => Validator::NotEmpty()->setName('密码'),
            'login_name' => Validator::NotEmpty()->setName('登录名'),
        ]);


        ['login_name' => $LoginName, 'password' => $password] = $data;

        $admin = AgentAuthService::instance()->login($LoginName, $password)->makeHidden('domains');

        return Response::success($admin);
    }


    /**
     * 详情
     *
     * @param Request $request
     * @return Response
     */
    public function info(Request $request): Response
    {
        $agent_id = $request->input('agent_id');

        $info = AgentService::instance()->getById($agent_id)->makeHidden('domains');

        return Response::success($info);
    }

    /**
     * 更新
     *
     * @param Request $request
     * @return Response
     * @throws TipsException
     */
    public function update(Request $request): Response
    {
        $data = $request->only(['name', 'avatar', 'password']);
        $agent_id = $request->input('agent_id');

        if (isset($data['password']) && $data['password']) {
            $data['password'] = passwordHash($data['password']);
        }

        AgentService::instance()->updateById($agent_id, $data);

        return Response::success();
    }
}

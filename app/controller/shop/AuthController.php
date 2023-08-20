<?php

namespace app\controller\shop;


use app\controller\Controller;
use app\service\AgentAuthService;
use app\service\AgentService;
use app\service\AgentShopAuthService;
use app\service\AgentShopService;
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
        $key = $request->header('key');

        Validator::input($data, [
            'password' => Validator::NotEmpty()->setName('密码'),
            'login_name' => Validator::NotEmpty()->setName('登录名'),
            'machine_id' => Validator::NotEmpty()->setName('设备码'),
        ]);


        ['login_name' => $LoginName, 'password' => $password, 'machine_id' => $machine_id] = $data;

        $shop = AgentShopAuthService::instance()->login($LoginName, $password, $machine_id);

        if (now() > $shop->expiry_time) {
            return Response::res(3000, '账号已过期,请联系管理员', $shop->only('id','month_money','quarter_money'), 200);
        }


        return Response::success($shop);
    }


    /**
     * 详情
     *
     * @param Request $request
     * @return Response
     */
    public function info(Request $request): Response
    {
        $agent_shop_id = $request->input('agent_shop_id');

        $info = AgentShopService::instance()->getById($agent_shop_id);

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

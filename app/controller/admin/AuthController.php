<?php

namespace app\controller\admin;


use app\controller\Controller;
use app\service\AdminUserAuthService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
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

        $admin = AdminUserAuthService::instance()->login($LoginName, $password);

        return Response::success($admin);
    }



}

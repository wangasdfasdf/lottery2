<?php

namespace app\middleware;


use app\service\AdminUserAuthService;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

class CheckAdminLogin implements MiddlewareInterface
{
    public function process(Request $request, callable $next): Response
    {
        $token = $request->header('token');

        $result = AdminUserAuthService::instance()->checkToken($token);

        $adminId = $result['model_id'] ?? 0;

        if (empty($adminId)) {
            return \support\Response::res(401, '请重新登录', [], 401);
        }

//        \request()->offSet('admin_user_id', $adminId);

        return $next($request);
    }

}

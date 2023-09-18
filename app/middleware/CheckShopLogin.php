<?php

namespace app\middleware;

use app\middleware\traits\SetSuffix;
use app\model\AgentShop;
use app\service\AgentShopAuthService;
use support\Log;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

class CheckShopLogin implements MiddlewareInterface
{
    use SetSuffix;

    public function process(Request $request, callable $next): Response
    {
        $machine_id = $request->header('machineId');

        $token = $request->header('token');

        $result = AgentShopAuthService::instance()->checkToken($token);

        $agent_shop_id = $result['model_id'] ?? 0;

        if (empty($agent_shop_id)) {
            return \support\Response::res(401, '请重新登录', [], 401);
        }

        if ($result['machine_id'] != $machine_id) {
            return \support\Response::res(401, '设备码错误', [], 401);
        }

        /**
         * @var AgentShop $shop
         */
        $shop = AgentShop::query()->where('id', $agent_shop_id)->first();

        if ($shop && $shop->expiry_time < now()) {
            return \support\Response::res(401, '店铺已过期', [], 401);
        }


        \request()->offSet('shop_id', $agent_shop_id);

        return $next($request);
    }

}

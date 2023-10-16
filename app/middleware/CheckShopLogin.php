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

        if ($shop->status == -1) {
            return \support\Response::res(401, '该账号被管理员禁用,请联系管理员.', [], 200);

        }


        if ($shop) {
            if ($shop->expiry_time < now()) {
                return \support\Response::res(3000, '账号已过期,请联系管理员', $shop->only('id', 'month_money', 'month2_money', 'half_year_money', 'year_money', 'quarter_money', 'wallet_address', 'wallet_address_img'), 200);
            }
        }


        \request()->offSet('shop_id', $agent_shop_id);

        return $next($request);
    }

}

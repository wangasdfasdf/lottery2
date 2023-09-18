<?php

namespace app\middleware;

use app\middleware\traits\SetSuffix;
use app\model\AgentShop;
use app\service\AgentShopAuthService;
use support\Log;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

class CheckShopExpiry implements MiddlewareInterface
{
    use SetSuffix;

    public function process(Request $request, callable $next): Response
    {
        $shopId = $request->input('shop_id');

        /**
         * @var AgentShop $shop
         */
        $shop = AgentShop::query()->find($shopId);

        Log::info(__METHOD__, compact('shop', 'shopId'));
        if ($shop->expiry_time < now()){
            return \support\Response::res(401, '店铺已过期', [], 401);
        }

        return $next($request);
    }

}

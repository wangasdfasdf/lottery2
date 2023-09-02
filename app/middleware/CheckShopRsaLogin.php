<?php

namespace app\middleware;

use app\middleware\traits\SetSuffix;
use app\service\AgentShopAuthService;
use app\service\RasService;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

class CheckShopRsaLogin implements MiddlewareInterface
{
    use SetSuffix;

    public function process(Request $request, callable $next): Response
    {
        $str = $request->input('sign','');

        $arr = RasService::instance()->privateDecode($str);

        if (!$arr) {
            return \support\Response::res(401, '密钥错误', [], 401);
        }

        if ($arr['client'] != 'contest.exe' || $arr['timestamp'] + 30 < time()) {
            return \support\Response::res(401, '请调整本地时间', [], 401);
        }

        return $next($request);
    }

}

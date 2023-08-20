<?php

namespace app\middleware;

use app\middleware\traits\SetSuffix;
use app\model\AgentConfig;
use app\model\AgentOrder;
use app\model\AgentShop;
use app\model\traits\Suffix;
use app\service\AdminUserAuthService;
use app\service\AgentAuthService;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

class CheckAgentLogin implements MiddlewareInterface
{
    use SetSuffix;
    public function process(Request $request, callable $next): Response
    {
        $token = $request->header('token');

        $result = AgentAuthService::instance()->checkToken($token);

        $agent_id = $result['model_id'] ?? 0;

        if (empty($agent_id)) {
            return \support\Response::res(401, '请重新登录', [], 401);
        }

        \request()->offSet('agent_id', $agent_id);


        $this->setSuffix($agent_id);

        return $next($request);
    }

}

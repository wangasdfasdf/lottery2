<?php

namespace app\middleware;

use app\enum\StatusEnum;
use app\middleware\traits\SetSuffix;
use app\model\Agent;
use app\model\AgentConfig;
use app\model\AgentOrder;
use app\model\AgentShop;
use support\Log;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

class CheckShopTag implements MiddlewareInterface
{
    use SetSuffix;

    public static array $agent_tag_map = [];

    public function process(Request $request, callable $next): Response
    {
        $tag = $request->header('tag');
        $machine_id = $request->header('machineId');


        if (empty($machine_id)) {
            return \support\Response::res(401, '设备码错误', [], 401);
        }

        if (!isset(self::$agent_tag_map[$tag]) && empty(self::$agent_tag_map[$tag])) {
            $agent_id = Agent::query()->where('tag', $tag)->where('status', StatusEnum::ENABLE)->value('id');

            if (empty($agent_id)) {
                return \support\Response::res(401, '代理错误', [], 401);
            }

            self::$agent_tag_map[$tag] = $agent_id;
        }

        $agent_id = self::$agent_tag_map[$tag];
        Log::info('CheckShopTag', compact('tag', 'agent_id'));
        $this->setSuffix($agent_id);

        \request()->offSet('machine_id', $machine_id);

        return $next($request);
    }

    public static function delAgentMap($tag): void
    {
        unset(self::$agent_tag_map[$tag]);
    }

}

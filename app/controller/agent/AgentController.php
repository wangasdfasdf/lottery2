<?php

namespace app\controller\agent;

use app\controller\Controller;
use app\service\AgentService;
use support\Request;
use support\Response;

class AgentController extends Controller
{
    public function address(Request $request): Response
    {
        $agent_id = $request->input('agent_id');

        $agent = AgentService::instance()->setWalletAddress($agent_id);

        return Response::success($agent);
    }
}
<?php

namespace app\controller\admin;


use app\controller\Controller;
use app\middleware\traits\SetSuffix;
use app\model\filter\OrderFilter;
use app\service\AgentOrderService;
use Respect\Validation\Validator;
use support\Request;
use support\Response;

class AgentOrderController extends Controller
{
    use SetSuffix;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param OrderFilter $filter
     * @return Response
     */
    public function index(Request $request, OrderFilter $filter): Response
    {
        Validator::input($request->all(), [
            'agent_id' => Validator::NotEmpty()->setName('代理'),
        ]);

        $agent_id = $request->input('agent_id');

        $this->setSuffix($agent_id);

        $data = AgentOrderService::instance()->getResourceList($filter, $request);

        return Response::success($data);
    }


    public function statistical(Request $request): Response
    {
        Validator::input($request->all(), [
            'agent_id' => Validator::NotEmpty()->setName('代理'),
        ]);

        $agent_id = $request->input('agent_id');

        $this->setSuffix($agent_id);

        $shopId = $request->input('shop_id', '');
        $startTime = $request->input('start_time', '');
        $endTime = $request->input('end_time', '');

        $shopId = explode(',', $shopId);
        $data = AgentOrderService::instance()->statistical($startTime, $endTime, $shopId);
        return Response::success($data);
    }

}

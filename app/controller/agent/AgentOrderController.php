<?php

namespace app\controller\agent;



use app\controller\Controller;
use app\model\filter\OrderFilter;
use app\service\AgentOrderService;
use support\Request;
use support\Response;

class AgentOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param OrderFilter $filter
     * @return Response
     */
    public function index(Request $request, OrderFilter $filter): Response
    {
        $data = AgentOrderService::instance()->getResourceList($filter, $request);

        return Response::success($data);
    }


    public function statistical(Request $request): Response
    {
        $shopId    = $request->input('shop_id', '');
        $startTime = $request->input('start_time', '');
        $endTime   = $request->input('end_time', '');

        $shopId = explode(',', $shopId);

        $data   = AgentOrderService::instance()->statistical($startTime, $endTime, $shopId);
        return Response::success($data);
    }

}

<?php
namespace app\controller\shop;

use app\controller\Controller;
use app\model\filter\AgentOrderFilter;
use app\service\AgentOrderService;
use Exception;
use support\exception\TipsException;
use support\Request;
use support\Response;

class AgentOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param AgentOrderFilter $filter
     * @return Response
     */
    public function index(Request $request, AgentOrderFilter $filter): Response
    {
        $data = AgentOrderService::instance()->getResourceList($filter, $request, []);

        return Response::success($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function store(Request $request): Response
    {
        $data = $request->all();
        $shopId = $request->input('shop_id');


        AgentOrderService::instance()->frontCreateOrder($data, $shopId);

        return Response::success();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function show(Request $request, int $id): Response
    {
        $shopId = $request->input('shop_id');
        $info = AgentOrderService::instance()->getById($id, shopId: $shopId);

        return Response::success($info);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws TipsException
     */
    public function update(Request $request, int $id): Response
    {
        $data = $request->all();
        $shopId = $request->input('shop_id');

        AgentOrderService::instance()->updateById($id, $data, $shopId);

        return Response::success();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws TipsException
     */
    public function destroy(int $id): Response
    {
        AgentOrderService::instance()->deleteById($id);

        return Response::success();
    }

    public function statistical(Request $request)
    {
        $shopId    = $request->input('shop_id');
        $startTime = $request->input('start_time');
        $endTime   = $request->input('end_time');

        $startTime = date('Y-m-d', \strtotime(\date('Y-m-d', \time() - 86400))) . ' 00:00:00';
        $endTime   = date('Y-m-d', \strtotime(\date('Y-m-d', \time() - 86400))) . ' 23:59:59';
        $data      = AgentOrderService::instance()->statistical($startTime, $endTime, [$shopId]);
        return Response::success($data);
    }
}

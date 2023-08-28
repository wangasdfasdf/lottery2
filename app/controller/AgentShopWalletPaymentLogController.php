<?php
namespace app\controller;

use app\model\filter\AgentShopWalletPaymentLogFilter;
use app\service\AgentShopWalletPaymentLogService;
use Exception;
use support\Request;
use support\Response;
use support\exception\TipsException;

class AgentShopWalletPaymentLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param AgentShopWalletPaymentLogFilter $filter
     * @return Response
     */
    public function index(Request $request, AgentShopWalletPaymentLogFilter $filter): Response
    {
        $data = AgentShopWalletPaymentLogService::instance()->getResourceList($filter, $request, []);

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
        AgentShopWalletPaymentLogService::instance()->create($data);

        return Response::success();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        $info = AgentShopWalletPaymentLogService::instance()->getById($id);

        return Response::success($info);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        $data = $request->all();
        AgentShopWalletPaymentLogService::instance()->updateById($id, $data);

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
        AgentShopWalletPaymentLogService::instance()->deleteById($id);

        return Response::success();
    }
}

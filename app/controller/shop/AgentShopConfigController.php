<?php
namespace app\controller\shop;

use app\controller\Controller;
use app\model\filter\AgentShopConfigFilter;
use app\service\AgentShopConfigService;
use Exception;
use support\exception\TipsException;
use support\Request;
use support\Response;

class AgentShopConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param AgentShopConfigFilter $filter
     * @return Response
     */
    public function index(Request $request, AgentShopConfigFilter $filter): Response
    {
        $data = AgentShopConfigService::instance()->getResourceList($filter, $request, []);

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
        AgentShopConfigService::instance()->create($data);

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
        $info = AgentShopConfigService::instance()->getById($id);

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
        AgentShopConfigService::instance()->updateById($id, $data);

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
        AgentShopConfigService::instance()->deleteById($id);

        return Response::success();
    }
}

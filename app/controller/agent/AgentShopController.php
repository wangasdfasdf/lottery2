<?php

namespace app\controller\agent;

use app\controller\Controller;
use app\model\AgentShop;
use app\model\filter\AgentShopFilter;
use app\service\AgentService;
use app\service\AgentShopService;
use Exception;
use support\exception\DdException;
use support\exception\TipsException;
use support\Request;
use support\Response;

class AgentShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param AgentShopFilter $filter
     * @return Response
     */
    public function index(Request $request, AgentShopFilter $filter): Response
    {
        $data = AgentShopService::instance()->getResourceList($filter, $request, []);
        $data['list'] = array_map(function ($item){
            $item->makeHidden('domain');
            return $item;
        }, $data['list']);
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

        AgentShopService::instance()->checkLoginNameUniqueOrThrow($data['login_name']);
        $data['password'] = passwordHash($data['password']);
        $data['expiry_time'] = now()->addHour();
        AgentShopService::instance()->create($data);

        return Response::success();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     * @throws DdException
     */
    public function show(int $id): Response
    {
        $info = AgentShopService::instance()->getById($id)->makeHidden('domain');

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

        unset($data['expiry_time']);

        if (isset($data['password']) && $data['password']) {
            $data['password'] = passwordHash($data['password']);
        }

        AgentShopService::instance()->updateById($id, $data);

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
        AgentShopService::instance()->deleteById($id);

        return Response::success();
    }

    public function expiryTime(Request $request): Response
    {
        $shop_id = $request->input('shop_id');
        $days = $request->input('days');
        $agent_id = $request->input('agent_id');

        AgentShopService::instance()->expiryTime($agent_id,$shop_id, $days);

        return Response::success();
    }
}

<?php

namespace app\controller\admin;

use app\controller\Controller;
use app\middleware\traits\SetSuffix;
use app\model\AgentShop;
use app\model\filter\AgentShopFilter;
use app\service\AgentService;
use app\service\AgentShopService;
use Exception;
use Respect\Validation\Validator;
use support\exception\DdException;
use support\exception\TipsException;
use support\Request;
use support\Response;

class AgentShopController extends Controller
{
    use SetSuffix;
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param AgentShopFilter $filter
     * @return Response
     */
    public function index(Request $request, AgentShopFilter $filter): Response
    {
        Validator::input($request->all(), [
            'agent_id' => Validator::NotEmpty()->setName('代理'),
        ]);

        $agent_id = $request->input('agent_id');

        $this->setSuffix($agent_id);

        $data = AgentShopService::instance()->getResourceList($filter, $request, []);

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
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function show(Request $request,int $id): Response
    {
        Validator::input($request->all(), [
            'agent_id' => Validator::NotEmpty()->setName('代理'),
        ]);

        $agent_id = $request->input('agent_id');

        $this->setSuffix($agent_id);

        $info = AgentShopService::instance()->getById($id);

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

}

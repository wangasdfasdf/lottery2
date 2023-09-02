<?php
namespace app\controller\admin;

use app\controller\Controller;
use app\model\filter\AgentAccountDaysLogFilter;
use app\service\AgentAccountDaysLogService;
use Exception;
use support\exception\TipsException;
use support\Request;
use support\Response;

class AgentAccountDaysLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param AgentAccountDaysLogFilter $filter
     * @return Response
     */
    public function index(Request $request, AgentAccountDaysLogFilter $filter): Response
    {
        $data = AgentAccountDaysLogService::instance()->getResourceList($filter, $request, []);

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
        AgentAccountDaysLogService::instance()->create($data);

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
        $info = AgentAccountDaysLogService::instance()->getById($id);

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
        AgentAccountDaysLogService::instance()->updateById($id, $data);

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
        AgentAccountDaysLogService::instance()->deleteById($id);

        return Response::success();
    }
}

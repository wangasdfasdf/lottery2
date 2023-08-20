<?php
namespace app\controller\shop;

use app\controller\Controller;
use app\model\filter\AgentFeedbackFilter;
use app\service\AgentFeedbackService;
use Exception;
use support\exception\TipsException;
use support\Request;
use support\Response;

class AgentFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param AgentFeedbackFilter $filter
     * @return Response
     */
    public function index(Request $request, AgentFeedbackFilter $filter): Response
    {
        $data = AgentFeedbackService::instance()->getResourceList($filter, $request, []);

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
        AgentFeedbackService::instance()->create($data);

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
        $info = AgentFeedbackService::instance()->getById($id);

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
        AgentFeedbackService::instance()->updateById($id, $data);

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
        AgentFeedbackService::instance()->deleteById($id);

        return Response::success();
    }

    public function isRead(Request $request):Response
    {
        $shopId = $request->input('shop_id');

        $read = AgentFeedbackService::instance()->isRead($shopId);

        return Response::success(compact('read'));
    }
}

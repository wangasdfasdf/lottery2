<?php
namespace app\controller\agent;

use app\controller\Controller;
use app\model\filter\AgentConfigFilter;
use app\service\AgentConfigService;
use Exception;
use Respect\Validation\Validator;
use support\exception\TipsException;
use support\Request;
use support\Response;

class AgentConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param AgentConfigFilter $filter
     * @return Response
     */
    public function index(Request $request, AgentConfigFilter $filter): Response
    {
        $data = AgentConfigService::instance()->getResourceList($filter, $request, []);

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
        Validator::input($data, [
            'key' => Validator::NotEmpty()->setName('key'),
        ]);
        AgentConfigService::instance()->create($data);

        return Response::success();
    }

    /**
     * Display the specified resource.
     *
     * @param string $key
     * @return Response
     */
    public function show(string $key): Response
    {
        $info = AgentConfigService::instance()->getField($key);

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
        AgentConfigService::instance()->updateById($id, $data);

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
        AgentConfigService::instance()->deleteById($id);

        return Response::success();
    }
}

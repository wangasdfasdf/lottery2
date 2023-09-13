<?php
namespace app\controller\shop;

use app\controller\Controller;
use app\model\filter\AdFilter;
use app\service\AdService;
use Exception;
use support\exception\TipsException;
use support\Request;
use support\Response;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param AdFilter $filter
     * @return Response
     */
    public function index(Request $request, AdFilter $filter): Response
    {
        $data = AdService::instance()->frontAll();

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
        AdService::instance()->create($data);

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
        $info = AdService::instance()->getById($id);

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
        AdService::instance()->updateById($id, $data);

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
        AdService::instance()->deleteById($id);

        return Response::success();
    }
}

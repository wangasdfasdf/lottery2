<?php

namespace app\controller\admin;

use app\controller\Controller;
use app\enum\StatusEnum;
use app\middleware\CheckShopTag;
use app\model\Agent;
use app\model\filter\AgentFilter;
use app\service\AdminUserService;
use app\service\AgentService;
use Exception;
use Respect\Validation\Validator;
use support\exception\TipsException;
use support\Request;
use support\Response;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param AgentFilter $filter
     * @return Response
     */
    public function index(Request $request, AgentFilter $filter): Response
    {

        $data = AgentService::instance()->getResourceList($filter, $request, []);

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
            'password' => Validator::NotEmpty()->setName('密码'),
            'password_confirmation' => Validator::equals($request->all()['password'])->setName('确认密码'),
            'login_name' => Validator::NotEmpty()->setName('登录名'),
            'avatar' => Validator::NotEmpty()->setName('头像'),
        ]);

        AgentService::instance()->checkLoginNameUniqueOrThrow($data['login_name']);

        $data['password'] = passwordHash($data['password']);
        $data['tag'] = uniqid('a');
        /**
         * @var Agent $agent
         */
        $agent = AgentService::instance()->create($data);


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
        $info = AgentService::instance()->getById($id);

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

        /**
         * @var Agent $agent
         */
        $agent = AgentService::instance()->updateById($id, $data);

        if (isset($data['status']) && $data['status'] == StatusEnum::DISABLE->value) {
            CheckShopTag::delAgentMap($agent->tag);
        }


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
        AgentService::instance()->deleteById($id);

        return Response::success();
    }

    public function accountDays(Request $request, $id): Response
    {
        $days = $request->input('days');

        AgentService::instance()->updateAccountDays($id, $days);

        return Response::success();
    }
}

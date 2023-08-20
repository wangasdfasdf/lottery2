<?php

namespace app\controller\admin;

use app\controller\Controller;
use app\model\filter\AdminUserFilter;
use app\service\AdminUserService;
use Exception;
use Illuminate\Support\Facades\Hash;
use Respect\Validation\Validator;
use support\exception\TipsException;
use support\Request;
use support\Response;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param AdminUserFilter $filter
     * @return Response
     */
    public function index(Request $request, AdminUserFilter $filter): Response
    {
        $data = AdminUserService::instance()->getResourceList($filter, $request, []);

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

        AdminUserService::instance()->checkLoginNameUniqueOrThrow($data['login_name']);


        $data['password'] = passwordHash($data['password']);
        AdminUserService::instance()->create($data);

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
        $info = AdminUserService::instance()->getById($id);

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

        AdminUserService::instance()->updateById($id, $data);

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
        AdminUserService::instance()->deleteById($id);

        return Response::success();
    }
}

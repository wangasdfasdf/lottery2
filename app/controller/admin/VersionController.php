<?php

namespace app\controller\admin;


use app\controller\Controller;
use app\enum\Key;
use Shopwwi\LaravelCache\Cache;
use support\Request;
use support\Response;

class VersionController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        unset($data['admin_id']);

        Cache::forever(Key::VERSION->value, $data);

        return Response::success();
    }

}

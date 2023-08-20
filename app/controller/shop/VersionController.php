<?php

namespace app\controller\shop;


use app\controller\Controller;
use app\enum\Key;
use Shopwwi\LaravelCache\Cache;
use support\Request;
use support\Response;

class VersionController extends Controller
{
    public function show(Request $request): array|Response
    {
        $appVersion = $request->input('app_version');

        return Response::success(Cache::get(Key::VERSION->value));
    }

}

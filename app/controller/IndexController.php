<?php

namespace app\controller;

use support\Request;

class IndexController
{
    public function index(Request $request)
    {
        static $readme;
        if (!$readme) {
            $readme = file_get_contents(base_path('README.md'));
        }
        return $readme;
    }

    public function view(Request $request)
    {
        return view('index/view', ['name' => 'webman']);
    }

    public function json(Request $request)
    {
        $request->offSet('aa', 'bb');
        $request->offSetUnSet('aaa');

        return json([
            'code' => 0,
            'data' => $request->all(),
            'msg' => 'ok'
        ]);
    }

}

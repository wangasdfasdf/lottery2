<?php

namespace app\controller\shop;

use app\controller\Controller;
use support\Request;
use support\Response;

class HistoryMatchController extends Controller
{
    public function show(Request $request, $path): Response
    {
        $day = $request->input('day');
        $hour = $request->input('hour');
        $minute = $request->input('minute');

        $filename = sprintf("%s_%s_%s.json", $path, $hour, $minute);

        $path = base_path('storage/lottery/jc/') . $day . '/';

        $data = [];
        if (file_exists($path . $filename)) {
            $data = file_get_contents($path . $filename);
            $data = json_decode($data, true);
        }

        return Response::success($data);
    }

    public function day(): Response
    {

        $start = \now();
        $days = range($start->unix(), $start->subDays(15)->unix(), 86400);

        $days = array_map(function ($item) {
            return date('Y-m-d', $item);
        }, $days);

        $hour = array_map(function ($item) {
            return ['h' => $item, 'i' => 30];
        }, range(11, 22));


        return Response::success(\compact('days', 'hour'));
    }
}

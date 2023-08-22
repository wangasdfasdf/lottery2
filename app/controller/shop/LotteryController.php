<?php

namespace app\controller\shop;

use app\controller\Controller;

use GuzzleHttp\Client;
use Shopwwi\LaravelCache\Cache;
use support\Request;
use support\Response;

class LotteryController extends Controller
{

    public function thirdResult(Request $request)
    {
        $url = 'https://webapi.sporttery.cn/gateway/report/getVtoolsConfigV1.qry?configKey=vtools:config:zc_app_loty_betshu';


        $key = md5($url);

        $data = Cache::remember($key . ':short', 600, function () use ($url, $key) {

            $client = new Client();

            $response = $client->get($url);

            if ($response->getStatusCode() == 200) {
                $body = $response->getBody();
                $result = json_decode($body, true);
                Cache::put($key . ':long', $result, 3600);
            } else {
                $result = Cache::get($key . ':long');
            }

            return  $result;
        });

        return Response::success($data);
    }
}
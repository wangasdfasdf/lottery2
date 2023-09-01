<?php

namespace app\controller\shop;

use app\controller\Controller;

use GuzzleHttp\Client;
use Shopwwi\LaravelCache\Cache;
use support\Log;
use support\Request;
use support\Response;

class LotteryController extends Controller
{

    public function thirdResult(Request $request): Response
    {
        $param = $request->input('param');
        $type = $request->input('type');

        $url = match ($type) {
            'getVtoolsConfigV1' => 'https://webapi.sporttery.cn/gateway/report/getVtoolsConfigV1.qry',
            'football' => 'https://webapi.sporttery.cn/gateway/jc/football/getMatchCalculatorV1.qry',
            'basketball' => 'https://webapi.sporttery.cn/gateway/jc/basketball/getMatchCalculatorV1.qry',
        };


        $key = md5($url) . json_encode($param);

        $data = Cache::remember($key . ':short', 600, function () use ($url, $key, $param) {

            $client = new Client();

            $response = $client->get($url, ['query' => $param]);

            if ($response->getStatusCode() == 200) {
                $body = $response->getBody();
                $result = json_decode($body, true);
                Cache::put($key . ':long', $result, 3600);
            } else {
                $result = Cache::get($key . ':long');
            }

            return $result;
        });

        return Response::success($data);
    }
}
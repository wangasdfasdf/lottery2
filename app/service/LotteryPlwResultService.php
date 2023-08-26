<?php

namespace app\service;

use app\model\LotteryPlwResult;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;

class LotteryPlwResultService extends BaseService
{
    public $model = 'app\model\LotteryPlwResult';

    /**
     * @throws GuzzleException
     */
    public function capture()
    {
        $url = "https://webapi.sporttery.cn/gateway/lottery/getHistoryPageListV1.qry";


        $client = new Client();

        $result = $client->get($url, ['query' => [
            'gameNo' => 350133,
            'provinceId' => 0,
            'pageSize' => 30,
            'isVerify' => 1,
            'pageNo' => 1,
        ]]);

        if ($result->getStatusCode() !== 200) {
            return;
        }

        $data = json_decode((string)$result->getBody(), true);


        $list = Arr::get($data, 'value.list');

        foreach ($list as $item) {

            $prizeLevelList = \array_column($item['prizeLevelList'], 'stakeAmount', 'prizeLevel');

            if (empty($prizeLevelList)){
                continue;
            }

            LotteryPlwResult::query()->firstOrCreate([
                'issue' => $item['lotteryDrawNum'],
            ], [
                'draw_result' => $item['lotteryDrawResult'],
                'amount' => \str_replace(',', '', $prizeLevelList['一等奖']),
                'result' => $item,
            ]);
        }
    }
}

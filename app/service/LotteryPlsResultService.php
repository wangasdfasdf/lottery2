<?php

namespace app\service;

use app\model\LotteryPlsResult;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class LotteryPlsResultService extends BaseService
{
    public $model = 'app\model\LotteryPlsResult';

    public function capture(): void
    {

        $url = "https://webapi.sporttery.cn/gateway/lottery/getHistoryPageListV1.qry";


        $client = new Client();

        $result = $client->get($url, ['query' => [
            'gameNo' => 35,
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

            if (empty($prizeLevelList)) {
                continue;
            }

            $tmpArr = \explode(' ', $item['lotteryDrawResult']);

            LotteryPlsResult::query()->firstOrCreate([
                'issue' => $item['lotteryDrawNum'],
            ], [
                'draw_result' => $item['lotteryDrawResult'],
                'amount1' => \str_replace(',', '', $prizeLevelList['直选']),
                'amount2' => \str_replace(',', '', $prizeLevelList['组选3']),
                'amount3' => \str_replace(',', '', $prizeLevelList['组选6']),
                'result' => $item,
                'kd' => \max($tmpArr) - \min($tmpArr),
                'hz' => \array_sum($tmpArr),
                'type' => match (\count(\array_unique(\explode(' ', ($item['lotteryDrawResult']))))) {
                    1 => 3,
                    2 => 1,
                    3 => 2,
                },
            ]);
        }
    }

    /**
     * 排列三 往期单号
     *
     * @return Collection|array
     */
    public function last20(): Collection|array
    {
        return LotteryPlsResult::query()
            ->selectRaw("issue, JSON_EXTRACT(result, '$.lotterySaleEndtime') as day")
            ->orderBy('id', 'desc')
            ->limit(20)
            ->get()->transform(function ($item) {
                $item->day = date("Y-m-d", strtotime(trim($item->day, '"')));
                return $item;
            });
    }
}

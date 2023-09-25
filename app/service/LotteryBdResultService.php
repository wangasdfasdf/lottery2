<?php

namespace app\service;

use app\model\LotteryBdResult;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use support\Log;
use function Symfony\Component\String\b;

class LotteryBdResultService extends BaseService
{
    public $model = 'app\model\LotteryBdResult';


    /**
     * @throws GuzzleException
     */
    public function capture(): void
    {
        $user = config('nmsj.user');
        $secret = config('nmsj.secret');
        $url = config('nmsj.db_result_url');
        $sp = 1;
        $client = new Client();

        try {
            $result = $client->get($url, ['query' => compact('user', 'secret', 'sp')]);

            if ($result->getStatusCode() !== 200) {
                return;
            }

            $body = json_decode((string)$result->getBody(), true);

            if (!isset($body['code']) || $body['code'] != 0) {
                return;
            }

            $data = $body['data'];


            foreach ($data as $itemss) {

                foreach ($itemss as $items) {
                    foreach ($items as $item) {

                        /**
                         * @var LotteryBdResult $model
                         */
                        $model = LotteryBdResult::query()->firstOrCreate(['match_id' => $item['id'], 'issue' => $item['issue'], 'issue_num' => $item['issue_num']], []);

                        $model->comp = $item['comp'];
                        $model->home = $item['home'];
                        $model->away = $item['away'];
                        $model->match_time = $item['match_time'];
                        $model->sell_status = $item['sell_status'];
                        $model->home_score = $item['home_score'];
                        $model->away_score = $item['away_score'];
                        $model->odds = array_merge($model->odds ?? [], $item['odds']);;
                        $model->sport_id = 1;
                        $model->save();
                    }
                }

            }

        } catch (\Exception $e) {
            Log::error(__METHOD__, [$e->getMessage()]);
        }


    }
}

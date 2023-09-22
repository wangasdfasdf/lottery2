<?php
namespace app\service;

use app\model\LotteryBdSfResult;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use support\Log;

class LotteryBdSfResultService extends BaseService
{
    public $model = 'app\model\LotteryBdSfResult';

    public function capture(): void
    {
        $user   = config('nmsj.user');
        $secret = config('nmsj.secret');
        $url    = config('nmsj.db_sf_result_url');
        $sp = 1;
        $client = new Client();

        $result = $client->get($url,  ['query' => compact('user', 'secret', 'sp')]);

        if ($result->getStatusCode() !== 200) {
            return;
        }

        $body = json_decode((string)$result->getBody(), true);

        if (!isset($body['code']) || $body['code'] != 0) {
            return;
        }

        $data = $body['data'];


        foreach ($data as $item) {

            foreach ($item as $key => $value) {

                foreach ($value as $value1) {
                    if ($value1['sport_id'] == 2) {
                        continue;
                    }

                    /**
                     * @var LotteryBdSfResult $model
                     */
                    $model = LotteryBdSfResult::query()->firstOrCreate(['match_id' => $value1['id'], 'issue' => $value1['issue'], 'issue_num' => $value1['issue_num']], []);

                    $model->comp        = $value1['comp'];
                    $model->home        = $value1['home'];
                    $model->away        = $value1['away'];
                    $model->match_time  = $value1['match_time'];
                    $model->sell_status = $value1['sell_status'];
                    $model->home_score  = $value1['home_score'];
                    $model->away_score  = $value1['away_score'];
                    $model->odds        = array_merge( $model->odds ?? [], $value1['odds']);
                    $model->sport_id    = $value1['sport_id'];
                    $model->save();
                }
            }


        }
    }
}

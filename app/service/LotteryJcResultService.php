<?php
namespace app\service;

use app\model\LotteryJcResult;
use GuzzleHttp\Client;
use support\Log;

class LotteryJcResultService extends BaseService
{
    public $model = 'app\model\LotteryJcResult';

    public function capture(): void
    {
        $user   = config('nmsj.user');
        $secret = config('nmsj.secret');
        $url    = config('nmsj.jc_result_url');

        $client = new Client();

        $result = $client->get($url,  ['query' => compact('user', 'secret')]);

        if ($result->getStatusCode() !== 200) {
            return;
        }

        $body = json_decode((string)$result->getBody(), true);

        if (!isset($body['code']) || $body['code'] != 0) {
            return;
        }

        $data = $body['data'];

        $jczq = $data['jczq'];

        foreach ($jczq as $item) {

            /**
             * @var LotteryJcResult $model
             */
            $model                  = LotteryJcResult::query()->firstOrCreate(['type' => 'jczq', 'match_id' => $item['id']], []);
            $model->comp            = $item['comp'];
            $model->home            = $item['home'];
            $model->away            = $item['away'];
            $model->short_comp      = $item['short_comp'];
            $model->short_home      = $item['short_home'];
            $model->short_away      = $item['short_away'];
            $model->issue_num       = $item['issue_num'];
            $model->match_time      = $item['match_time'];
            $model->home_score      = $item['home_score'];
            $model->away_score      = $item['away_score'];
            $model->half_home_score = $item['half_home_score'];
            $model->half_away_score = $item['half_away_score'];
            $model->spf             = $item['spf'];
            $model->rq              = $item['rq'];
            $model->bf              = $item['bf'];
            $model->jq              = $item['jq'];
            $model->bqc             = $item['bqc'];
            $model->save();
        }

        $jclq = $data['jclq'];

        foreach ($jclq as $item) {

            /**
             * @var LotteryJcResult $model
             */
            $model                  = LotteryJcResult::query()->firstOrCreate(['type' => 'jclq', 'match_id' => $item['id']], []);
            $model->comp            = $item['comp'];
            $model->home            = $item['home'];
            $model->away            = $item['away'];
            $model->short_comp      = $item['short_comp'];
            $model->short_home      = $item['short_home'];
            $model->short_away      = $item['short_away'];
            $model->issue_num       = $item['issue_num'];
            $model->match_time      = $item['match_time'];
            $model->home_score      = $item['home_score'];
            $model->away_score      = $item['away_score'];
            $model->sf              = $item['sf'];
            $model->rf              = $item['rf'];
            $model->sfc             = $item['sfc'];
            $model->dxf             = $item['dxf'];
            $model->save();
        }
    }

}

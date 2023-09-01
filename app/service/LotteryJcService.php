<?php

namespace app\service;

use app\model\LotteryJcResult;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use function DI\string;

class LotteryJcService extends BaseService
{
    public $model = 'app\model\LotteryJcResult';

    private array $urls = [
        [
            'name' => 'getVtoolsConfigV1',
            'url' => 'https://webapi.sporttery.cn/gateway/report/getVtoolsConfigV1.qry',
            'param' => [
                'configKey' => 'vtools:config:zc_app_loty_betshu',
            ],
        ],
        [
            'name' => 'basketballGetMatchCalculatorV1',
            'url' => 'https://webapi.sporttery.cn/gateway/jc/basketball/getMatchCalculatorV1.qry',
            'param' => [
                'poolCode' => '',
                'channel' => 'c',
            ],
        ],
        [
            'name' => 'footballGetMatchCalculatorV1',
            'url' => 'https://webapi.sporttery.cn/gateway/jc/football/getMatchCalculatorV1.qry',
            'param' => [
                'poolCode' => '',
                'channel' => 'c',
            ],
        ],
    ];

    public function history(): void
    {
        $client = new Client();

        foreach ($this->urls as $item) {
            $this->putFile($item['url'], $item['param'], $item['name'], $client);
        }
    }

    /**
     * @throws GuzzleException
     */
    public function putFile(string $url, array $param, string $name, Client $client): void
    {
        $hour = date('H');
        $minute = 30;
        $path = base_path('storage/lottery/jc/') . date("Ymd") . '/';

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $filename = sprintf("%s_%s_%s.json", $name, $hour, $minute);

        if (file_exists($path . $filename)) {
            return;
        }

        $result = $client->get($url, ['query' => $param]);

        if ($result->getStatusCode() == 200) {

            file_put_contents($path . $filename, (string)$result->getBody());
        } else {
            $this->putFile($url, $param, $name, $client);
        }
    }

    public function syncCancelLottery(): void
    {
        $url = "https://webapi.sporttery.cn/gateway/jc/football/getMatchResultV1.qry";

        $client = new Client();

        $result = $client->get($url, ['query' => [
            'matchPage' => 1,
            'matchBeginDate' => now()->subDays(2)->format("Y-m-d"),
            'matchEndDate' => now()->format("Y-m-d"),
            'leagueId' => '',
            'pageSize' => 30,
            'pageNo' => 1,
            'isFix' => 0,
            'pcOrWap' => 1,
        ]]);

        if ($result->getStatusCode() != 200) {
            return;
        }

        $data = json_decode((string)$result->getBody(), true);

        $matchResult = Arr::get($data, 'value.matchResult', []);
        foreach ($matchResult as $item) {

            if ($item['sectionsNo999'] == '取消'){
                LotteryJcResult::query()->firstOrCreate([
                    'match_id' => $item['match_id'],
                    'type' => 'jczq',
                ],[
                    'comp' => '',
                    'home' => $item['allHomeTeam'],
                    'away' => $item['allAwayTeam'],
                    'short_comp' => '',
                    'short_home' => '',
                    'short_away' => '',
                    'issue_num' => $item['matchNum'],
                    'match_time' => 0,
                    'home_score' => 0,
                    'away_score' => 0,
                    'half_home_score' => 0,
                    'half_away_score' => 0,
                ]);
            }
        }
    }
}

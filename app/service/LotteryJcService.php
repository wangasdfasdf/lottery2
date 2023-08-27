<?php

namespace app\service;

use app\model\LotteryJcResult;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
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
}

<?php

namespace app\service;

use app\enum\AgentAccountDaysLogType;
use app\enum\ConfigKey;
use app\model\Agent;
use app\model\AgentWalletPaymentLog;
use app\model\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use function DI\string;

class AgentWalletPaymentLogService extends BaseService
{
    public $model = 'app\model\AgentWalletPaymentLog';

    private string $url = 'http://47.102.145.104/api/sync/wallet';

    /**
     * 抓取代理充值
     *
     * @return void
     * @throws GuzzleException
     */
    public function capture()
    {

        $data = Config::query()->where('key', 'wallet_address')->value('value');

        if (empty($data)){
            return;
        }

        $data = \json_decode($data, true);

        $client = new Client();

        foreach ($data as $item) {
            $relatedAddress = $item['address'];

            if (empty($relatedAddress)) {
                return;
            }

            $start = 0;

            do {
                $result = $client->get($this->url, [
                    'query' => [
                        'limit' => 20,
                        'start' => $start,
                        'sort' => '-timestamp',
                        'count' => 'true',
                        'filterTokenValue' => 0,
                        'relatedAddress' => $relatedAddress,
                    ]
                ]);

                if ($result->getStatusCode() != 200) {
                    return;
                }


                $result = (string)$result->getBody();

                $result = \json_decode($result, true);

                $data = Arr::get($result, 'token_transfers');
                $rangeTotal = Arr::get($result, 'rangeTotal');

                if (\is_array($data)) {

                    foreach ($data as $item) {
                        $transactionId = Arr::get($item, "transaction_id");
                        $fromAddress = Arr::get($item, "from_address");
                        $toAddress = Arr::get($item, "to_address");
                        $amount = Arr::get($item, "quant");
                        $transferTime = Arr::get($item, "block_ts");

                        $id = AgentWalletPaymentLog::query()->where('transaction_id', $transactionId)->value('id');

                        if ($id) {
                            break 2;
                        }

                        if ($toAddress != $relatedAddress) {
                            continue;
                        }

                        $shopId = 0;
                        $shopName = '';
                        $days = 0;

                        /**
                         * @var Agent $agent
                         */
                        $agent = Agent::query()->where('wallet_address', $toAddress)->first();

                        if ($agent) {
                            $shopId = $agent->id;
                            $shopName = $agent->login_name;
                            $tmp = $amount / 1000000;
                            $days = $tmp * $agent->u2day;
                            $agent->wallet_address = '';
                            $agent->wallet_address_img = '';
                            $agent->account_days += $days;
                            $agent->save();


                            AgentAccountDaysLogService::instance()->createOne($agent, $days, AgentAccountDaysLogType::U_CHARGE, 0, [
                                'agent_id' => $shopId,
                                'agent_name' => $shopName,
                                'amount' => $amount,
                                'transfer_time' => $transferTime,
                                'from_address' => $fromAddress,
                                'to_address' => $toAddress,
                                'days' => $days,
                                'transaction_id' => $transactionId,
                                'result' => $item,
                                'model' => 'agent_wallet_payment_log',
                            ]);
                        }

                        AgentWalletPaymentLog::query()->create([
                            'agent_id' => $shopId,
                            'agent_name' => $shopName,
                            'amount' => $amount,
                            'transfer_time' => $transferTime,
                            'from_address' => $fromAddress,
                            'to_address' => $toAddress,
                            'days' => $days,
                            'transaction_id' => $transactionId,
                            'result' => $item,
                        ]);
                    }
                }

                $start += 20;
            } while ($start < $rangeTotal);
        }
    }

}

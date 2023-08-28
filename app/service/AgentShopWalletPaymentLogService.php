<?php

namespace app\service;

use app\enum\AgentAccountDaysLogType;
use app\enum\AgentShopExpiryTimeLogType;
use app\enum\ConfigKey;
use app\middleware\traits\SetSuffix;
use app\model\Agent;
use app\model\AgentConfig;
use app\model\AgentShop;
use app\model\AgentShopWalletPaymentLog;
use app\model\AgentWalletPaymentLog;
use app\model\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;

class AgentShopWalletPaymentLogService extends BaseService
{
    use SetSuffix;

    public $model = 'app\model\AgentShopWalletPaymentLog';
    private string $url = 'http://47.102.145.104/api/sync/wallet';

    /**
     * 抓取代理充值
     *
     * @return void
     * @throws GuzzleException
     */
    public function capture(): void
    {

        $agents = Agent::query()->get();

        foreach ($agents as $agent) {
            $this->setSuffix($agent->id);

            $data = AgentConfig::query()->where('key', 'wallet_address')->value('value');

            if (empty($data)) {
                continue;
            }
            $data = \json_decode($data, true);

            if (empty($data)) {
                continue;
            }
            $client = new Client();

            foreach ($data as $item) {
                $relatedAddress = $item['address'];

                if (empty($relatedAddress)) {
                    continue;
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
                        break;
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

                            $id = AgentShopWalletPaymentLog::query()->where('transaction_id', $transactionId)->value('id');

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
                             * @var AgentShop $shop
                             */
                            $shop = AgentShop::query()->where('wallet_address', $toAddress)->first();


                            if ($shop) {
                                $shopId = $shop->id;
                                $shopName = $shop->login_name;
                                $tmp = $amount / 1000000;
                                $days = match (true) {
                                    abs(($shop->month_money ?? 0) - $tmp) < 5 => 30,
                                    abs(($shop->quarter_money ?? 0) - $tmp) < 5 => 90,
                                    abs(($shop->half_year_money ?? 0) - $tmp) < 5 => 180,
                                    abs(($shop->year_money ?? 0) - $tmp) < 5 => 365,
                                    default => 0
                                };

                                /**
                                 * @var Agent $agent
                                 */
                                $agent = Agent::query()->find($agent->id);

                                if ($agent->account_days > $days){
                                    $start_time = $shop->expiry_time;

                                    $shop->wallet_address = '';
                                    $shop->wallet_address_img = '';
                                    $shop->expiry_time = ($shop->expiry_time < now()) ? now()->addDays($days) : $shop->expiry_time->addDays($days);
                                    $shop->save();

                                    AgentShopExpiryTimeLogService::instance()->createOne($shop, $days, $start_time, AgentShopExpiryTimeLogType::U_CHARGE, [
                                        'shop_id' => $shopId,
                                        'shop_name' => $shopName,
                                        'amount' => $amount,
                                        'transfer_time' => $transferTime,
                                        'from_address' => $fromAddress,
                                        'to_address' => $toAddress,
                                        'days' => $days,
                                        'transaction_id' => $transactionId,
                                        'result' => $item,
                                        'model' => 'agent_shop_wallet_payment_log',
                                    ]);
                                }
                            }

                            AgentShopWalletPaymentLog::query()->create([
                                'shop_id' => $shopId,
                                'shop_name' => $shopName,
                                'amount' => $amount,
                                'transfer_time' => $transferTime,
                                'from_address' => $fromAddress,
                                'to_address' => $toAddress,
                                'type' => $days,
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

}

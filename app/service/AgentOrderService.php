<?php

namespace app\service;


use app\enum\OrderWinningStatus;
use app\middleware\traits\SetSuffix;
use app\model\Agent;
use app\model\AgentConfig;
use app\model\AgentOrder;
use app\model\AgentShop;
use app\model\LotteryBdResult;
use app\model\LotteryBdSfResult;
use app\model\LotteryJcResult;
use App\Models\MatchResult;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class AgentOrderService extends BaseService
{
    use SetSuffix;

    public $model = 'app\model\AgentOrder';

    public function getById(int $id, $columns = ['*'], int $shopId = 0)
    {
        return AgentOrder::query()->where('shop_id', $shopId)->find($id);
    }

    public function updateById(int $id, array $arrtibute, int $shopId = 0): Model|Collection|Builder|array|null
    {

        try {
            $model = AgentOrder::query()->where('shop_id', $shopId)->findOrFail($id);
            $model->fill($arrtibute);
            $model->save();
            return $model;
        } catch (\Throwable $th) {
            $this->throw($th->getMessage());
        }
    }

    public function frontCreateOrder(mixed $data, mixed $shopId): array
    {
        $serial_numbers = $order_numbers = $order_ids = [];
        $data['create_time'] = now();
        /**
         * @var AgentShop $shop
         */
        $shop = AgentShop::query()->find($shopId);

        $printTimes = \explode('@', $data['print_time']);


        foreach ($printTimes as $key => $printTime) {
            $print_order_no = get_order_num($data['type'], $shop->order_prefix);
            $tmp = $data['detail'];
            $data['order_no'] = $this->getOrderNo($shopId);
            $data['print_order_no'] = $print_order_no;
            $data['print_time'] = $printTime;

            $order_numbers[] = $print_order_no;
            if ($data['type'] == 'bjdc') {
                $detail = $data['detail'];
                $content = $detail['content'];
                $passMethod = $this->formatPassMethod($detail['pass_method']);
                $detail['pass_method'] = $passMethod;
                $detail['content'] = $this->getBJDCDetail($passMethod, $content);
                $detail['matchno'] = $this->getMatchNo($content);
                $data['detail'] = $detail;
            }

            if (\in_array($data['type'], ['bjdc', 'pls'])) {
                $serial_number = \str_pad(\mt_rand(1, 300), 5, '0', STR_PAD_LEFT);
                $data['serial_number'] = $serial_number;
                $serial_numbers[] = $serial_number;

            }

            $order = parent::create($data);
            $order_ids[] = $order->id;
            $this->runOrderIsWinning($order);

            $data['detail'] = $tmp;
        }

        return \compact('serial_numbers', 'order_numbers', 'order_ids');
    }

    /**
     * 获取订单号
     *
     * @param int $shpId
     * @return string
     * @created_at 2022/10/19
     */
    public function getOrderNo(int $shpId): string
    {
        return date("YmdHi") . $shpId . mt_rand(1000, 9999);
    }

    public function formatPassMethod(array $arr): array
    {
        $tmp = [];
        foreach ($arr as $item) {
            $tmp[] = match ($item) {
                "单关" => 1,
                "2串1" => 2,
                "3串1" => 3,
                "4串1" => 4,
                "5串1" => 5,
                "6串1" => 6,
                "7串1" => 7,
                "8串1" => 8,
                "9串1" => 9,
                "10串1" => 10,
                "11串1" => 11,
                "12串1" => 12,
                "13串1" => 13,
                "14串1" => 14,
                "15串1" => 15,
                "16串1" => 16,
                default => $item,
            };
        }

        return $tmp;
    }

    public function getBJDCDetail($passMethod, array $content)
    {
        $installData = [];

        $data = $this->formatArr($content);
        foreach ($passMethod as $item) {

            if ($item == 1) {
                \array_map(function ($item) use (&$installData) {
                    foreach ($item as $v) {
                        $arr = \explode('_', $v);
                        $installData [][] = [
                            'match_no' => $arr[0],
                            'result' => $arr[1]
                        ];
                    }
                    return [];
                }, $data);
                continue;
            }


            $aa = $this->combination(\array_keys($data), $item);

            foreach ($aa as $a) {
                $arr = \array_map(function ($item) use ($data) {
                    return $data[$item];
                }, $a);
                $val = Arr::crossJoin(...$arr);


                \array_map(function ($item) use (&$installData) {
                    $tmp = [];
                    foreach ($item as $v) {
                        $arr = \explode('_', $v);
                        $tmp[] = [
                            'match_no' => $arr[0],
                            'result' => $arr[1]
                        ];
                    }
                    $installData[] = $tmp;
                    return [];
                }, $val);
            }
        }
        return $installData;
    }

    public function formatArr(array $data): array
    {
        $arr = [];
        foreach ($data as $key => $value) {
            $tmp = [];
            foreach ($value as $item) {
                $tmp[] = $key . '_' . $item;
            }
            $arr[] = $tmp;
        }

        return $arr;
    }


    // 组合
    public function combination($array, $m): array
    {
        $r = array();

        $n = count($array);
        if ($m <= 0 || $m > $n) {
            return $r;
        }

        for ($i = 0; $i < $n; $i++) {
            $t = array($array[$i]);
            if ($m == 1) {
                $r[] = $t;
            } else {
                $b = array_slice($array, $i + 1);
                $c = $this->combination($b, $m - 1);
                foreach ($c as $v) {
                    $r[] = array_merge($t, $v);
                }
            }
        }

        return $r;
    }

    public function getMatchNo(array $content): array
    {
        return \array_keys($content);
    }


    public function statistical(string $startTime, string $endTime, array $shopId): array
    {
        $shopId = array_filter($shopId);

        $model = AgentOrder::query()->when($startTime, function (Builder $query) use ($startTime) {
            $query->where('created_at', '>=', $startTime);
        })->when($endTime, function (Builder $query) use ($endTime) {
            $query->where('created_at', '<=', $endTime);
        })->when(!empty($shopId), function (Builder $query) use ($shopId) {
            $query->whereIn('shop_id', $shopId);
        });


        $model1 = clone $model;
        $model2 = clone $model;
        $model3 = clone $model;
        $model4 = clone $model;

        $totalNum = $model1->count();
        $totalAmount = $model2->sum('bet_amount');
        $winningNum = $model3->where('winning_status', OrderWinningStatus::WINNING)->count();
        $winningAmount = $model4->where('winning_status', OrderWinningStatus::WINNING)->sum('wining_amount');

        return [
            'total_num' => $totalNum,
            'total_amount' => $totalAmount,
            'winning_num' => $winningNum,
            'winning_amount' => $winningAmount,
        ];
    }

    /**
     * 获取打印订单内容
     *
     * @param int $order_id
     * @param $dom_height
     * @param int $shop_id
     * @return string
     */
    public function printInfo(int $order_id, $dom_height, int $shop_id, $is_redeem): string
    {
        /**
         * @var AgentOrder $order
         */
        $order = AgentOrder::query()->where('shop_id', $shop_id)->find($order_id);

        $printAds = AgentConfig::query()->where('key', 'print_ads')->value('value');

        $data['params'] = $order->toArray();
        $data['userInfo'] = AgentShop::query()->select('order_prefix', 'bottom_code', 'print_type', 'address')->find($order->shop_id)->toArray();
        $data['printAds'] = $printAds ? json_decode($printAds) : [];
        $data['dom_height'] = $dom_height;
        $data['is_redeem'] = $is_redeem;

        $param = base64_encode(json_encode($data));

        $str = sprintf("node %s --args=%s", base_path("print_server.js"), $param);
        exec($str, $output);

        return $output[0];
    }

    /**
     * 计算是否中奖
     *
     * @return void
     */
    public function calculate(): void
    {
        $agent_ids = Agent::query()->pluck('id');
        foreach ($agent_ids as $agent_id) {
            $this->setSuffix($agent_id);

            AgentOrder::query()->where('winning_status', OrderWinningStatus::UNDRAWN)->chunkById(100, function ($orders) {
                foreach ($orders as $order) {
                    $this->runOrderIsWinning($order);;
                }
            });
        }
    }


    /**
     * 判断订单是否中奖
     *
     * @param AgentOrder $order
     * @created_at 2022/12/3
     */
    public function runOrderIsWinning(AgentOrder $order)
    {
        $method = 'calculate' . ucwords($order->type);

        if (!method_exists($this, $method)) {
            return;
        }

        $this->$method($order);
    }

    public function calculateBjdc(AgentOrder $order)
    {
        $detail = $order->detail;

        $awardPeriod = Arr::get($detail, 'award_period', '');
        $passType = Arr::get($detail, 'pass_type', '');
        $matchno = Arr::get($detail, 'matchno', []);
        $content = Arr::get($detail, 'content', []);


        $column = match ($passType) {
            "dcbf" => 'bf',
            "zjq" => 'jq',
            default => $passType,
        };

        $type = match ($passType) {
            'spf' => '200',  //北单胜平负
            'dcbf' => '250', //北单单场比分
            'zjq' => '230',  //北单总进球数
            'bqc' => '240',  //北单半场胜平负
            'sxp' => '210',  //北单上下盘单双数
            'sf' => '270',   //北单胜负过关
        };

        $winingAmount = 0;

        $lotteryResult = LotteryBdResult::query()->where('issue', $awardPeriod)
            ->whereIn('issue_num', $matchno)
            ->get();

        if ($passType == 'sf') {
            $lotteryResult = LotteryBdSfResult::query()->where('issue', $awardPeriod)
                ->select('issue_num')->whereIn('issue_num', $matchno)
                ->get();

        }


        if (\count($matchno) != \count($lotteryResult)) {
            return;
        }

        foreach ($content as $item) {
            $temAmount = 1;

            foreach ($item as $value) {

                $resultItem = $lotteryResult->firstWhere('issue_num', $value['match_no']);
                $odds = $resultItem->value('odds');

                $itemResult = $value['result'];

                $this->checkBdResult($column, $value['result'], $odds[$column]);


                if ($type == 200) {
                    $itemResult = match ($itemResult) {
                        '胜' => 3,
                        '平' => 1,
                        '负' => 0,
                    };
                }
                $n = 0;
                if ($resultItem->result == $itemResult) {
                    $temAmount *= $resultItem['sp_value'];
                } elseif ($resultItem->result == '*') {
                    $n = '1';
                    $temAmount *= 1;
                } else {
                    $temAmount *= 0;
                }
            }
            if (count($item) == 1 && isset($n) && $n == 1) {
                $tmpAmount = 2;
            } else {
                $tmpAmount = \floor($temAmount * 0.65 * 2 * 100) / 100;
            }

            if ($tmpAmount > 10000) {
                $tmpAmount = $tmpAmount * 0.8;
            }

            $tmpAmount = $order->bet_multiplier * $tmpAmount;

            $winingAmount += $tmpAmount;

        }

        $order->winning_status = empty($winingAmount) ? OrderWinningStatus::NOT_WON : OrderWinningStatus::WINNING;

        $order->wining_amount = abs($winingAmount);


        $order->save();

    }


    public function calculateFootball(AgentOrder $order)
    {
        $detail = $order->detail;
        $matchIds = Arr::get($detail, 'match_ids', []);

        //押注详情
        $content = Arr::get($detail, 'detail', []);

        //中奖结果
        $result = LotteryJcResult::query()->whereIn('match_id', $matchIds)->where('type', $order->type)->get();

        dd($result, $matchIds);
    }

    public function calculatePls(AgentOrder $order)
    {
        dd(__METHOD__);
    }

    public function calculateBasketball(AgentOrder $order)
    {
        dd(__METHOD__);
    }

    private function checkBdResult(string $type, mixed $bet, array $result)
    {
        if ($result['rb1'] == '*' || (isset($result['bf2']) && $result['rb2'] == '*')) {
            return [true, 1];
        }

        if ($type == 'spf') {
            $bet = match ($bet) {
                '胜' => 3,
                '平' => 1,
                '负' => 0,
            };

            if ($result['rb2'] == $bet) {
                return [true, $result['sp']];
            }
            return [false, 0];
        }

        if ($type == 'bf') {

            var_dump($bet, $result);
        }
    }


}

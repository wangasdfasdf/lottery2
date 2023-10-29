<?php

namespace app\service;


use app\enum\OrderWinningStatus;
use app\middleware\traits\SetSuffix;
use app\model\Agent;
use app\model\AgentConfig;
use app\model\AgentOrder;
use app\model\AgentShop;
use app\model\AgentShopTicketConfig;
use app\model\LotteryBdResult;
use app\model\LotteryBdSfResult;
use app\model\LotteryJcResult;
use app\model\LotteryPlsResult;
use App\Models\MatchResult;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use support\Log;

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

//            $order_numbers[] = $print_order_no;
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
//                $serial_numbers[] = $serial_number;

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


        $todayModel = AgentOrder::query()->whereDate('created_at', now()->format("Y-m-d"))
            ->when(!empty($shopId), function (Builder $query) use ($shopId) {
                $query->whereIn('shop_id', $shopId);
            });
        $totalAmount2 = clone $todayModel;

        $model1 = clone $model;
        $model2 = clone $model;
        $model3 = clone $model;
        $model4 = clone $model;

        $totalNum = $model1->count();
        $totalAmount = $model2->sum('bet_amount');
        $winningNum = $model3->whereIn('winning_status', [OrderWinningStatus::WINNING, OrderWinningStatus::REDEEM])->count();
        $winningAmount = $model4->whereIn('winning_status', [OrderWinningStatus::WINNING, OrderWinningStatus::REDEEM])->sum('wining_amount');

        return [
            'total_num' => $totalNum,
            'total_amount' => $totalAmount,
            'winning_num' => $winningNum,
            'winning_amount' => $winningAmount,
            'today_num' => $todayModel->count(),
            'today_amount' => $totalAmount2->sum('bet_amount'),
        ];
    }

    /**
     * 获取打印订单内容
     *
     * @param int $order_id
     * @param $dom_height
     * @param int $shop_id
     * @param $is_redeem
     * @return string
     */
    public function printInfo(int $order_id, $dom_height, int $shop_id, $is_redeem): string
    {
        /**
         * @var AgentOrder $order
         */
        $order = AgentOrder::query()->where('shop_id', $shop_id)->find($order_id);

        $printAds = AgentConfig::query()->where('key', 'print_ads')->value('value');

        $type = match ($order->type) {
            'bjdc' => 'bd',
            'basketball', 'football' => 'jc',
            'pls' => 'pls',
        };

        $data['params'] = $order->toArray();
//        $data['userInfo'] = AgentShop::query()->select('order_prefix', 'bottom_code', 'print_type', 'address')->find($order->shop_id)->toArray();
//        $data['printAds'] = $printAds ? json_decode($printAds) : [];
        $data['dom_height'] = $dom_height;
        $data['is_redeem'] = $is_redeem;
        $data['print_conf'] = AgentShopTicketConfig::query()->where('shop_id', $shop_id)->where('type', $type)->first();

        $param = base64_encode(json_encode($data));

        $filePath = base_path("order_info" . time() . mt_rand(1, 999) . '.text');

        file_put_contents($filePath, $param);
//        $str = sprintf("node %s --args=%s", base_path("print_server.js"), $param);
        $str = sprintf("node %s --files=%s", base_path("print_server.js"), $filePath);
        exec($str, $output);

        $str1 = sprintf("rm -f %s", $filePath);
        exec($str1, $output1);

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
    public function runOrderIsWinning(AgentOrder $order): void
    {
        $method = 'calculate' . ucwords($order->type);

        if (!method_exists($this, $method)) {
            return;
        }

        $this->$method($order);
    }

    /**
     * 北京单场
     *
     * @param AgentOrder $order
     * @return void
     */
    public function calculateBjdc(AgentOrder $order): void
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

        $winingAmount = 0;

        $lotteryResult = LotteryBdResult::query()->where('issue', $awardPeriod)
            ->whereIn('issue_num', $matchno)
            ->get();


        if ($passType == 'sf') {
            $lotteryResult = LotteryBdSfResult::query()->where('issue', $awardPeriod)
                ->whereIn('issue_num', $matchno)
                ->get();
        }


        if (\count($matchno) != count($lotteryResult)) {
            return;
        }


        foreach ($content as $item) {
            $temAmount = 1;

            foreach ($item as $value) {

                $resultItem = $lotteryResult->firstWhere('issue_num', $value['match_no']);


                $odds = $resultItem->odds;

                list($result, $ps) = $this->checkBdResult($column, $value['result'], $odds[$column]);


                $temAmount *= $ps;
            }

            if ($temAmount == 1) {
                $tmpAmount = 2 * $order->bet_multiplier;
            } else {
                $tmpAmount = $temAmount * 0.65 * 2;

                if ($tmpAmount > 10000) {
                    $tmpAmount *= 0.8;
                }

                $tmpAmount = floor($tmpAmount * $order->bet_multiplier * 100) / 100;
            }

            $winingAmount += $tmpAmount;
        }

        $order->winning_status = empty($winingAmount) ? OrderWinningStatus::NOT_WON : OrderWinningStatus::WINNING;

        $order->wining_amount = abs($winingAmount);
        $order->original_wining_amount = abs($winingAmount);

        $order->save();
    }


    public function calculateFootball(AgentOrder $order): void
    {
        $detail = $order->detail;
        $matchIds = Arr::get($detail, 'match_ids', []);

        //押注详情
        $content = Arr::get($detail, 'detail', []);

        $type = match ($order->type) {
            'football' => 'jczq',
            'basketball' => 'jclq',
        };

        //中奖结果
        $result = LotteryJcResult::query()->whereIn('match_id', $matchIds)->where('type', $type)->get();


        if ($result->count() != count($matchIds)) {
            return;
        }

        $totalAmount = 0;
        foreach ($content as $item) {
            //这组中奖结果
            $odds = 1;
            foreach ($item as $item1) {
                $singleResult = $result->firstWhere('match_id', $item1['matchId']);

                list($r, $ps) = $this->checkJczqResult($singleResult, $item1);


                $odds *= $ps;
            }


            $totalAmount += format_jc_amount(2 * $odds) * $order->bet_multiplier;
        }

        $order->winning_status = empty($totalAmount) ? OrderWinningStatus::NOT_WON : OrderWinningStatus::WINNING;
        $order->wining_amount = $totalAmount;
        $order->original_wining_amount = $totalAmount;
        $order->save();
    }

    public function calculatePls(AgentOrder $order): void
    {
        $detail = $order->detail;
        $drawnNu = Arr::get($detail, 'drawn_um');
        $type = Arr::get($detail, 'type');     // 1.直选  2.组三 3.组六 4:直组混选

        $category = Arr::get($detail, 'category'); //  1标准选号  2.和值投注 3.跨度投注 4.组合复式 5.组合胆拖 6:号码直选 7:2码全包 8:直选二同 9:直选三同
        $content = Arr::get($detail, 'content');

        /**
         * @var LotteryPlsResult $result
         */
        $result = LotteryPlsResult::query()->where('issue', $drawnNu)->first();

        if (empty($result)) {
            return;
        }

        $drawResult = $result->draw_result;
        $drawResultArr = \explode(' ', $drawResult);

        //中奖的是组三还是组六
        $resultType = \count($drawResultArr) == \count(\array_unique($drawResultArr)) ? 3 : 2;
        $value = 'stake_amount_' . $resultType;

        $winingAmount = 0;
        if ($type == 1 && $category == 1) {
            if (\in_array($drawResultArr[0], $content['first']) && \in_array($drawResultArr[1], $content['two']) && \in_array($drawResultArr[2], $content['three'])) {
                $winingAmount = $result->amount1;
            }
        }

        if (\in_array($type, [2, 3]) && $category == 1) {
            if ($resultType == 3 && $type == 3 && empty(\array_diff($drawResultArr, $content['first']))) {
                $winingAmount = $result->amount3;
            }

            if ($resultType == 2 && $type == 2 && empty(\array_diff(\array_unique($drawResultArr), $content['first']))) {
                $winingAmount = $result->amount2;
            }
        }


        if ($category == 2) {
            if (in_array(\array_sum($drawResultArr), $content['first'])) {
                $winingAmount = match ($type) {
                    '1' => $result->amount1,
                    default => $result->$value,
                };
            }
        }

        if ($category == 3) {
            if (\in_array(\max($drawResultArr) - \min($drawResultArr), $content['first']) && ($type == 1 || $type == $resultType)) {
                $winingAmount = match ($type) {
                    '2' => $result->amount2,
                    '3' => $result->amount3,
                };
            }
        }

        if (in_array($type, [1, 2, 3]) && $category == 4) {
            if (empty(\array_diff($drawResultArr, $content['first'])) && $resultType == 3) {
                $winingAmount = $result->amount1;
            }
        }

        if ($category == 5 && ($type == 1 || $type == $resultType)) {
            $diff = \array_diff(\array_unique($drawResultArr), $content['first']);
            if (\count($diff) == (\count(\array_unique($drawResultArr)) - \count($content['first'])) && empty(\array_diff($diff, $content['two']))) {
                $winingAmount = match ($type) {
                    '1' => $result->amount1,
                    '2' => $result->amount2,
                    '3' => $result->amount3,
                };
            }
        }

        if ($category == 6) {
            if ($type == 1) {
                foreach ($content as $item) {
                    if ($item == $drawResult) {
                        $winingAmount += $result->amount1;
                    }
                }
            } else {
                \sort($drawResultArr);
                foreach ($content as $item) {
                    $tmp = \explode(' ', $item);
                    \sort($tmp);

                    if ($drawResultArr == $tmp) {
                        $winingAmount += ($resultType == 3 ? $result->amount3 : $result->amount2);
                    }
                }
            }
        }

        //2码全包
        if (in_array($type, [2, 3]) && $category == 7) {
            $first = $content['first'];
            $t = 0;
            foreach ($drawResultArr as $i) {
                if (in_array($i, $first)) {
                    $t++;
                }
            }
            if ($t >= 2) {
                $winingAmount += ($resultType == 3 ? $result->amount3 : $result->amount2);
            }
        }

        //8:直选二同
        if ($type == 1 && $category == 8 && $result->type == 1) {
            $first = $content['first'];
            $t = 0;
            foreach ($drawResultArr as $i) {
                if (in_array($i, $first)) {
                    $t++;
                }
            }
            if ($t >= 2) {
                $winingAmount += $result->amount1;
            }
        }

        //9:直选三同
        if ($type == 1 && $category == 8 && $result->type == 3) {
            $first = $content['first'];

            if (in_array($drawResult[0], $first)) {
                $winingAmount += $result->amount1;
            }
        }

        // 4:直组混选
        if ($type == 4) {
            sort($drawResultArr);
            foreach ($content as $item) {
                if ($item['type'] == 1) {

                    if ($result->draw_result == $item['content']) {
                        $winingAmount += ($result->amount1 * $item['bet_multiplier']);
                    }

                } else {
                    $c = explode(' ', $item['content']);
                    sort($c);

                    if ($drawResultArr == $c) {
                        $winingAmount += (($resultType == 3 ? $result->amount3 : $result->amount2) * $item['bet_multiplier']);
                    }
                }
            }

            goto aa;
        }


        $winingAmount = $winingAmount * $order->bet_multiplier;
        aa:
        $order->winning_status = empty($winingAmount) ? OrderWinningStatus::NOT_WON : OrderWinningStatus::WINNING;
        $order->wining_amount = $winingAmount;
        $order->original_wining_amount = $winingAmount;
        $order->save();
    }

    public function calculateBasketball(AgentOrder $order)
    {
        $this->calculateFootball($order);
    }

    private function checkBdResult(string $type, mixed $bet, array $result)
    {
        if ($result['rb1'] == '*' || (isset($result['rb2']) && $result['rb2'] == '*')) {
            return [true, 1];
        }

        if ($type == 'spf') {
            $bet = match ($bet) {
                '胜' => 3,
                '平' => 1,
                '负' => 0,
            };
            return match (true) {
                $bet == $result['rb2'] => [true, $result['sp']],
                default => [false, 0],
            };
        }

        if ($type == 'bf') {
            return match (true) {
                $bet == format_result_bf($result['rb1']) => [true, $result['sp']],
                default => [false, 0],
            };
        }

        if ($type == 'jq') {
            return match (true) {
                $bet == format_result_bd_jq($result['rb1']) => [true, $result['sp']],
                default => [false, 0],
            };
        }

        if ($type == 'bqc') {
            return match (true) {
                $bet == ($result['rb1'] . '-' . $result['rb2']) => [true, $result['sp']],
                default => [false, 0],
            };
        }

        if ($type == 'sxp') {
            $rb1 = match ($result['rb1']) {
                '4' => '上',
                '5' => '下',
            };
            $rb2 = match ($result['rb2']) {
                '6' => '单',
                '7' => '双',
            };
            return match (true) {
                $bet == $rb1 . $rb2 => [true, $result['sp']],
                default => [false, 0],
            };
        }

        if ($type == 'sf') {
            $bet = match ($bet) {
                '胜' => 3,
                '负' => 0,
            };
            return match (true) {
                $bet == $result['rb2'] => [true, $result['sp']],
                default => [false, 0],
            };
        }
    }

    private function checkJczqResult($singleResult, mixed $item)
    {

        $column = match ($item['code']) {
            'HHAD' => 'rq',
            'HAFU' => 'bqc',
            'CRS' => 'bf',
            'TTG' => 'jq',
            'HAD' => 'spf',

            "HILO" => 'dxf',
            "HDC" => 'rf',
            "MNL", => 'sf',
            "WNM", => 'sfc',
        };

        $result = $singleResult->$column;

        if (empty($result)) {
            return [true, 1];
        }

        $combination = strtr($item['combination'], [
            "A" => 0,
            "D" => 1,
            "H" => 3,
        ]);

        if ($column == 'rq') {
            $arr = explode(',', $result);

            return match (true) {
                $combination == $arr[1] => [true, $item['odds']],
                default => [false, 0],
            };
        }

        if ($column == 'bqc') {
            $arr = explode(',', $result);
            return match (true) {
                $combination == $arr[0] . ':' . $arr[1] => [true, $item['odds']],
                default => [false, 0],
            };
        }

        if ($column == 'spf') {
            $arr = explode(',', $result);

            return match (true) {
                $combination == $arr[0] => [true, $item['odds']],
                default => [false, 0],
            };
        }

        if ($column == 'jq') {
            $arr = explode(',', $result);

            return match (true) {
                $item['combination'] == $arr[0] => [true, $item['odds']],
                default => [false, 0],
            };
        }

        if ($column == 'bf') {
            $arr = explode(',', $result);
            $combination = match ($item['combination']) {
                '-1:-H' => '胜其他',
                '-1:-D' => '平其他',
                '-1:-A' => '负其他',
                default => $item['combination'],
            };

            return match (true) {
                $combination == $arr[0] => [true, $item['odds']],
                default => [false, 0],
            };
        }

        if ($column == 'rf') {
            $r = $singleResult->home_score + $item['goalLine'] > $singleResult->away_score ? 3 : 0;

            return match (true) {
                $combination == $r => [true, $item['odds']],
                default => [false, 0],
            };
        }

        if ($column == 'dxf') {
            $r = $singleResult->home_score + $singleResult->away_score > $item['goalLine'] ? "H" : "L";

            return match (true) {
                $item['combination'] == $r => [true, $item['odds']],
                default => [false, 0],
            };
        }

        if ($column == 'sf') {
            $arr = explode(',', $result);
            return match (true) {
                $combination == $arr[0] => [true, $item['odds']],
                default => [false, 0],
            };
        }

        if ($column == 'sfc') {

            if ($item['combination'] < 0) {
                $combination = abs($item['combination']);
            } else {
                $combination = $item['combination'] + 6;
            }
            $arr = explode(',', $result);

            return match (true) {
                $combination == $arr[0] => [true, $item['odds']],
                default => [false, 0],
            };
        }
    }

    public function redeem($shop_id, mixed $order_id): void
    {
        /**
         * @var AgentOrder $order
         */
        $order = AgentOrder::query()->where('id', $order_id)->where('shop_id', $shop_id)->first();
        $order->winning_status = OrderWinningStatus::REDEEM;
        $order->save();
    }

    private function checkPlsResult(LotteryPlsResult $result, array $detail)
    {
        $drawnNu = Arr::get($detail, 'drawn_um');
        $type = Arr::get($detail, 'type');     // 1.直选  2.组三 3.组六 4:直组混选

        $category = Arr::get($detail, 'category'); //  1标准选号  2.和值投注 3.跨度投注 4.组合复式 5.组合胆拖 6:号码直选 7:2码全包 8:直选二同 9:直选三同
        $content = Arr::get($detail, 'content');

        $winingAmount = 0;

        //投注组三  中奖结果不是组三
        if ($type == 2 && $result->type != 1) {
            return [false, 0];
        }

        //投注组六  中奖结果不是组六
        if ($type == 3 && $result->type != 2) {
            return [false, 0];
        }

    }


}

<?php

namespace app\service;


use app\enum\OrderWinningStatus;
use app\model\AgentConfig;
use app\model\AgentOrder;
use app\model\AgentShop;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class AgentOrderService extends BaseService
{
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
        $serial_numbers = $order_numbers = [];
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
            $this->runOrderIsWinning($order);

            $data['detail'] = $tmp;
        }

        return \compact('serial_numbers', 'order_numbers');
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

    /**
     * 判断订单是否中奖
     *
     * @param AgentOrder $order
     * @created_at 2022/12/3
     */
    public function runOrderIsWinning(AgentOrder $order)
    {

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

    public function printInfo(int $order_id, $dom_height, int $shop_id): array
    {
        /**
         * @var AgentOrder $order
         */
        $order = AgentOrder::query()->find($order_id);

        $data['param'] = $order->toArray();
        $data['userInfo'] = AgentShop::query()->select('order_prefix', 'bottom_code', 'print_type', 'address')->find($shop_id)->toArray();
        $data['printAds'] = json_decode(AgentConfig::query()->where('key', 'print_ads')->value('value'));
        $data['dom_height'] = $dom_height;

        $param = base64_encode(json_encode($data));

        $str = sprintf("node %s --args=%s", base_path("print_server.js"), $param);

        dd($str);
        exec($str, $output);

        return $output;
    }
}

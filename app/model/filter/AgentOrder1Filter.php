<?php
namespace app\model\filter;


use app\model\abstract\QueryFilter;


class AgentOrder1Filter extends QueryFilter
{

    /**
     * 过滤
     *
     * @param $id
     * @return mixed
     */
    public function id($id)
    {
        return $this->builder->where('id', $id);
    }


    /**
     * 过滤店铺ID
     *
     * @param $shopId
     * @return mixed
     */
    public function shopId($shopId)
    {
        return $this->builder->where('shop_id', $shopId);
    }


    /**
     * 过滤订单号
     *
     * @param $orderNo
     * @return mixed
     */
    public function orderNo($orderNo)
    {
        return $this->builder->where('order_no', $orderNo);
    }


    /**
     * 过滤打印订单号
     *
     * @param $printOrderNo
     * @return mixed
     */
    public function printOrderNo($printOrderNo)
    {
        return $this->builder->where('print_order_no', $printOrderNo);
    }


    /**
     * 过滤用户昵称
     *
     * @param $userName
     * @return mixed
     */
    public function userName($userName)
    {
        return $this->builder->where('user_name', $userName);
    }


    /**
     * 过滤下单时间
     *
     * @param $createTime
     * @return mixed
     */
    public function createTime($createTime)
    {
        return $this->builder->where('create_time', $createTime);
    }


    /**
     * 过滤状态
     *
     * @param $status
     * @return mixed
     */
    public function status($status)
    {
        return $this->builder->where('status', $status);
    }


    /**
     * 过滤投注信息
     *
     * @param $bettingInfo
     * @return mixed
     */
    public function bettingInfo($bettingInfo)
    {
        return $this->builder->where('betting_info', $bettingInfo);
    }


    /**
     * 过滤方案截止时间
     *
     * @param $planEndTime
     * @return mixed
     */
    public function planEndTime($planEndTime)
    {
        return $this->builder->where('plan_end_time', $planEndTime);
    }


    /**
     * 过滤店铺名称
     *
     * @param $shopName
     * @return mixed
     */
    public function shopName($shopName)
    {
        return $this->builder->where('shop_name', $shopName);
    }


    /**
     * 过滤店铺地址
     *
     * @param $shopAddress
     * @return mixed
     */
    public function shopAddress($shopAddress)
    {
        return $this->builder->where('shop_address', $shopAddress);
    }


    /**
     * 过滤店铺联系方式
     *
     * @param $shopLink
     * @return mixed
     */
    public function shopLink($shopLink)
    {
        return $this->builder->where('shop_link', $shopLink);
    }


    /**
     * 过滤过关类型
     *
     * @param $passType
     * @return mixed
     */
    public function passType($passType)
    {
        return $this->builder->where('pass_type', $passType);
    }


    /**
     * 过滤注数
     *
     * @param $betNumber
     * @return mixed
     */
    public function betNumber($betNumber)
    {
        return $this->builder->where('bet_number', $betNumber);
    }


    /**
     * 过滤投注倍数
     *
     * @param $betMultiplier
     * @return mixed
     */
    public function betMultiplier($betMultiplier)
    {
        return $this->builder->where('bet_multiplier', $betMultiplier);
    }


    /**
     * 过滤投注金额
     *
     * @param $betAmount
     * @return mixed
     */
    public function betAmount($betAmount)
    {
        return $this->builder->where('bet_amount', $betAmount);
    }


    /**
     * 过滤过关方式
     *
     * @param $passMethod
     * @return mixed
     */
    public function passMethod($passMethod)
    {
        return $this->builder->where('pass_method', $passMethod);
    }


    /**
     * 过滤投注类型
     *
     * @param $betType
     * @return mixed
     */
    public function betType($betType)
    {
        return $this->builder->where('bet_type', $betType);
    }


    /**
     * 过滤投注信息
     *
     * @param $betInfo
     * @return mixed
     */
    public function betInfo($betInfo)
    {
        return $this->builder->where('bet_info', $betInfo);
    }


    /**
     * 过滤最高奖励
     *
     * @param $highestReward
     * @return mixed
     */
    public function highestReward($highestReward)
    {
        return $this->builder->where('highest_reward', $highestReward);
    }


    /**
     * 过滤打印时间
     *
     * @param $printTime
     * @return mixed
     */
    public function printTime($printTime)
    {
        return $this->builder->where('print_time', $printTime);
    }


    /**
     * 过滤投注信息(后端使用)
     *
     * @param $detail
     * @return mixed
     */
    public function detail($detail)
    {
        return $this->builder->where('detail', $detail);
    }


    /**
     * 过滤football:足球 basketball:篮球
     *
     * @param $type
     * @return mixed
     */
    public function type($type)
    {
        return $this->builder->where('type', $type);
    }


    /**
     * 过滤undrawn:未开奖，winning:中奖,not_won:未中奖
     *
     * @param $winningStatus
     * @return mixed
     */
    public function winningStatus($winningStatus)
    {
        return $this->builder->where('winning_status', $winningStatus);
    }


    /**
     * 过滤中奖金额
     *
     * @param $winingAmount
     * @return mixed
     */
    public function winingAmount($winingAmount)
    {
        return $this->builder->where('wining_amount', $winingAmount);
    }


    /**
     * 过滤1是往期  2正常
     *
     * @param $isPast
     * @return mixed
     */
    public function isPast($isPast)
    {
        return $this->builder->where('is_past', $isPast);
    }


    /**
     * 过滤序号
     *
     * @param $serialNumber
     * @return mixed
     */
    public function serialNumber($serialNumber)
    {
        return $this->builder->where('serial_number', $serialNumber);
    }


    /**
     * 过滤
     *
     * @param $createdAt
     * @return mixed
     */
    public function createdAt($createdAt)
    {
        return $this->builder->where('created_at', $createdAt);
    }


    /**
     * 过滤
     *
     * @param $updatedAt
     * @return mixed
     */
    public function updatedAt($updatedAt)
    {
        return $this->builder->where('updated_at', $updatedAt);
    }


    /**
     * 过滤
     *
     * @param $deletedAt
     * @return mixed
     */
    public function deletedAt($deletedAt)
    {
        return $this->builder->where('deleted_at', $deletedAt);
    }



}

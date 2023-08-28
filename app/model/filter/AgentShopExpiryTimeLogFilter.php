<?php
namespace app\model\filter;


use app\model\abstract\QueryFilter;


class AgentShopExpiryTimeLogFilter extends QueryFilter
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
     * 过滤店铺id
     *
     * @param $shopId
     * @return mixed
     */
    public function shopId($shopId)
    {
        return $this->builder->where('shop_id', $shopId);
    }


    /**
     * 过滤增加天数
     *
     * @param $days
     * @return mixed
     */
    public function days($days)
    {
        return $this->builder->where('days', $days);
    }


    /**
     * 过滤开始的到期时间
     *
     * @param $startExpiryTime
     * @return mixed
     */
    public function startExpiryTime($startExpiryTime)
    {
        return $this->builder->where('start_expiry_time', $startExpiryTime);
    }


    /**
     * 过滤结束的到期时间
     *
     * @param $endExpiryTime
     * @return mixed
     */
    public function endExpiryTime($endExpiryTime)
    {
        return $this->builder->where('end_expiry_time', $endExpiryTime);
    }


    /**
     * 过滤类型
     *
     * @param $type
     * @return mixed
     */
    public function type($type)
    {
        return $this->builder->where('type', $type);
    }


    /**
     * 过滤
     *
     * @param $other
     * @return mixed
     */
    public function other($other)
    {
        return $this->builder->where('other', $other);
    }



}

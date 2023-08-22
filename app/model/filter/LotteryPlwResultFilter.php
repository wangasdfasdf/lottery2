<?php
namespace app\model\filter;


use app\model\abstract\QueryFilter;


class LotteryPlwResultFilter extends QueryFilter
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
     * 过滤彩票期号
     *
     * @param $issue
     * @return mixed
     */
    public function issue($issue)
    {
        return $this->builder->where('issue', $issue);
    }


    /**
     * 过滤开奖结果
     *
     * @param $drawResult
     * @return mixed
     */
    public function drawResult($drawResult)
    {
        return $this->builder->where('draw_result', $drawResult);
    }


    /**
     * 过滤直选奖金
     *
     * @param $amount
     * @return mixed
     */
    public function amount($amount)
    {
        return $this->builder->where('amount', $amount);
    }


    /**
     * 过滤结果集
     *
     * @param $result
     * @return mixed
     */
    public function result($result)
    {
        return $this->builder->where('result', $result);
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

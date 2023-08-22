<?php
namespace app\model\filter;


use app\model\abstract\QueryFilter;


class LotteryPlsResultFilter extends QueryFilter
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
     * @param $amount1
     * @return mixed
     */
    public function amount1($amount1)
    {
        return $this->builder->where('amount1', $amount1);
    }


    /**
     * 过滤组选3奖金
     *
     * @param $amount2
     * @return mixed
     */
    public function amount2($amount2)
    {
        return $this->builder->where('amount2', $amount2);
    }


    /**
     * 过滤组选6奖金
     *
     * @param $amount3
     * @return mixed
     */
    public function amount3($amount3)
    {
        return $this->builder->where('amount3', $amount3);
    }


    /**
     * 过滤跨度值
     *
     * @param $kd
     * @return mixed
     */
    public function kd($kd)
    {
        return $this->builder->where('kd', $kd);
    }


    /**
     * 过滤和值
     *
     * @param $hz
     * @return mixed
     */
    public function hz($hz)
    {
        return $this->builder->where('hz', $hz);
    }


    /**
     * 过滤1:组三类型  2:组六类型 3:豹子
     *
     * @param $type
     * @return mixed
     */
    public function type($type)
    {
        return $this->builder->where('type', $type);
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

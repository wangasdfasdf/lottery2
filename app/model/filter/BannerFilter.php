<?php
namespace app\model\filter;


use app\model\abstract\QueryFilter;


class BannerFilter extends QueryFilter
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
     * 过滤名称
     *
     * @param $name
     * @return mixed
     */
    public function name($name)
    {
        return $this->builder->where('name', $name);
    }


    /**
     * 过滤图片地址
     *
     * @param $url
     * @return mixed
     */
    public function url($url)
    {
        return $this->builder->where('url', $url);
    }


    /**
     * 过滤跳转类型
     *
     * @param $jumpType
     * @return mixed
     */
    public function jumpType($jumpType)
    {
        return $this->builder->where('jump_type', $jumpType);
    }


    /**
     * 过滤跳转的值
     *
     * @param $jumpValue
     * @return mixed
     */
    public function jumpValue($jumpValue)
    {
        return $this->builder->where('jump_value', $jumpValue);
    }


    /**
     * 过滤状态 1:启用 -1:禁用
     *
     * @param $status
     * @return mixed
     */
    public function status($status)
    {
        return $this->builder->where('status', $status);
    }


    /**
     * 过滤开始时间
     *
     * @param $startTime
     * @return mixed
     */
    public function startTime($startTime)
    {
        return $this->builder->where('start_time', $startTime);
    }


    /**
     * 过滤结束时间
     *
     * @param $endTime
     * @return mixed
     */
    public function endTime($endTime)
    {
        return $this->builder->where('end_time', $endTime);
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



}

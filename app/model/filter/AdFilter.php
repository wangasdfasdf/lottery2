<?php

namespace app\model\filter;


use app\model\abstract\QueryFilter;


class AdFilter extends QueryFilter
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
     * @param $title
     * @return mixed
     */
    public function title($title)
    {
        return $this->builder->where('title', 'like', "%{$title}%");
    }


    /**
     * 过滤位置
     *
     * @param $position
     * @return mixed
     */
    public function position($position)
    {
        return $this->builder->where('position', $position);
    }


    /**
     * 过滤图片
     *
     * @param $image
     * @return mixed
     */
    public function image($image)
    {
        return $this->builder->where('image', $image);
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

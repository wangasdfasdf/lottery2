<?php
namespace app\model\filter;


use app\model\abstract\QueryFilter;


class ConfigFilter extends QueryFilter
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
     * 过滤建
     *
     * @param $key
     * @return mixed
     */
    public function key($key)
    {
        return $this->builder->where('key', $key);
    }


    /**
     * 过滤值
     *
     * @param $value
     * @return mixed
     */
    public function value($value)
    {
        return $this->builder->where('value', $value);
    }


    /**
     * 过滤描述
     *
     * @param $desc
     * @return mixed
     */
    public function desc($desc)
    {
        return $this->builder->where('desc', $desc);
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

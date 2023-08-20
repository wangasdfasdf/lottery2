<?php
namespace app\model\filter;


use app\model\abstract\QueryFilter;


class AppVersionFilter extends QueryFilter
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
     * 过滤版本号
     *
     * @param $version
     * @return mixed
     */
    public function version($version)
    {
        return $this->builder->where('version', $version);
    }


    /**
     * 过滤版本描述
     *
     * @param $desc
     * @return mixed
     */
    public function desc($desc)
    {
        return $this->builder->where('desc', $desc);
    }


    /**
     * 过滤下载地址
     *
     * @param $download
     * @return mixed
     */
    public function download($download)
    {
        return $this->builder->where('download', $download);
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

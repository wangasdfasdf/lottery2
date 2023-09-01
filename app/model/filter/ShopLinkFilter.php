<?php
namespace app\model\filter;


use app\model\abstract\QueryFilter;


class ShopLinkFilter extends QueryFilter
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
     * 过滤代理Id
     *
     * @param $agentId
     * @return mixed
     */
    public function agentId($agentId)
    {
        return $this->builder->where('agent_id', $agentId);
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
     * 过滤姓名
     *
     * @param $name
     * @return mixed
     */
    public function name($name)
    {
        return $this->builder->where('name', $name);
    }


    /**
     * 过滤电话
     *
     * @param $phone
     * @return mixed
     */
    public function phone($phone)
    {
        return $this->builder->where('phone', $phone);
    }


    /**
     * 过滤QQ
     *
     * @param $qq
     * @return mixed
     */
    public function qq($qq)
    {
        return $this->builder->where('qq', $qq);
    }


    /**
     * 过滤wechat
     *
     * @param $wechat
     * @return mixed
     */
    public function wechat($wechat)
    {
        return $this->builder->where('wechat', $wechat);
    }


    /**
     * 过滤备注
     *
     * @param $note
     * @return mixed
     */
    public function note($note)
    {
        return $this->builder->where('note', $note);
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

<?php
namespace app\model\filter;


use app\model\abstract\QueryFilter;


class AgentShopTicketConfigFilter extends QueryFilter
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
     * 过滤订单号前缀
     *
     * @param $orderPrefix
     * @return mixed
     */
    public function orderPrefix($orderPrefix)
    {
        return $this->builder->where('order_prefix', $orderPrefix);
    }


    /**
     * 过滤店铺地址
     *
     * @param $address
     * @return mixed
     */
    public function address($address)
    {
        return $this->builder->where('address', $address);
    }


    /**
     * 过滤ad:广告版  address:地址版
     *
     * @param $printType
     * @return mixed
     */
    public function printType($printType)
    {
        return $this->builder->where('print_type', $printType);
    }


    /**
     * 过滤地板编码
     *
     * @param $bottomCode
     * @return mixed
     */
    public function bottomCode($bottomCode)
    {
        return $this->builder->where('bottom_code', $bottomCode);
    }


    /**
     * 过滤二维码
     *
     * @param $qrCode
     * @return mixed
     */
    public function qrCode($qrCode)
    {
        return $this->builder->where('qr_code', $qrCode);
    }


    /**
     * 过滤广告内容
     *
     * @param $adContent
     * @return mixed
     */
    public function adContent($adContent)
    {
        return $this->builder->where('ad_content', $adContent);
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

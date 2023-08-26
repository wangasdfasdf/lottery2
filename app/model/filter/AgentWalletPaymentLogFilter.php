<?php
namespace app\model\filter;


use app\model\abstract\QueryFilter;


class AgentWalletPaymentLogFilter extends QueryFilter
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
     * 过滤代理ID
     *
     * @param $agentId
     * @return mixed
     */
    public function agentId($agentId)
    {
        return $this->builder->where('agent_id', $agentId);
    }


    /**
     * 过滤代理名称
     *
     * @param $agentName
     * @return mixed
     */
    public function agentName($agentName)
    {
        return $this->builder->where('agent_name', $agentName);
    }


    /**
     * 过滤转账金额
     *
     * @param $amount
     * @return mixed
     */
    public function amount($amount)
    {
        return $this->builder->where('amount', $amount);
    }


    /**
     * 过滤转账时间
     *
     * @param $transferTime
     * @return mixed
     */
    public function transferTime($transferTime)
    {
        return $this->builder->where('transfer_time', $transferTime);
    }


    /**
     * 过滤转账账户
     *
     * @param $fromAddress
     * @return mixed
     */
    public function fromAddress($fromAddress)
    {
        return $this->builder->where('from_address', $fromAddress);
    }


    /**
     * 过滤收款账户
     *
     * @param $toAddress
     * @return mixed
     */
    public function toAddress($toAddress)
    {
        return $this->builder->where('to_address', $toAddress);
    }


    /**
     * 过滤交易单号
     *
     * @param $transactionId
     * @return mixed
     */
    public function transactionId($transactionId)
    {
        return $this->builder->where('transaction_id', $transactionId);
    }


    /**
     * 过滤交易信息
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

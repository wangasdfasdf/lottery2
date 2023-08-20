<?php
namespace app\model\filter;


use app\model\abstract\QueryFilter;


class AgentFeedbackFilter extends QueryFilter
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
     * 过滤问题
     *
     * @param $problem
     * @return mixed
     */
    public function problem($problem)
    {
        return $this->builder->where('problem', $problem);
    }


    /**
     * 过滤回复
     *
     * @param $reply
     * @return mixed
     */
    public function reply($reply)
    {
        return $this->builder->where('reply', $reply);
    }


    /**
     * 过滤回复时间
     *
     * @param $replyTime
     * @return mixed
     */
    public function replyTime($replyTime)
    {
        return $this->builder->where('reply_time', $replyTime);
    }


    /**
     * 过滤-1:未读  1:已读
     *
     * @param $isRead
     * @return mixed
     */
    public function isRead($isRead)
    {
        return $this->builder->where('is_read', $isRead);
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

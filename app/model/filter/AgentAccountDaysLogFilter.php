<?php
namespace app\model\filter;


use app\model\abstract\QueryFilter;


class AgentAccountDaysLogFilter extends QueryFilter
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
     * 过滤天数
     *
     * @param $days
     * @return mixed
     */
    public function days($days)
    {
        return $this->builder->where('days', $days);
    }


    /**
     * 过滤开始天数
     *
     * @param $startDays
     * @return mixed
     */
    public function startDays($startDays)
    {
        return $this->builder->where('start_days', $startDays);
    }


    /**
     * 过滤结束天数
     *
     * @param $endDays
     * @return mixed
     */
    public function endDays($endDays)
    {
        return $this->builder->where('end_days', $endDays);
    }


    /**
     * 过滤类型
     *
     * @param $type
     * @return mixed
     */
    public function type($type)
    {
        return $this->builder->where('type', $type);
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

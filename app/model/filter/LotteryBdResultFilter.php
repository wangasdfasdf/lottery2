<?php
namespace app\model\filter;


use app\model\abstract\QueryFilter;


class LotteryBdResultFilter extends QueryFilter
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
     * 过滤唯一，用于和“体彩关联接口”中的比赛关联
     *
     * @param $matchId
     * @return mixed
     */
    public function matchId($matchId)
    {
        return $this->builder->where('match_id', $matchId);
    }


    /**
     * 过滤赛事名称
     *
     * @param $comp
     * @return mixed
     */
    public function comp($comp)
    {
        return $this->builder->where('comp', $comp);
    }


    /**
     * 过滤主队名称
     *
     * @param $home
     * @return mixed
     */
    public function home($home)
    {
        return $this->builder->where('home', $home);
    }


    /**
     * 过滤客队名称
     *
     * @param $away
     * @return mixed
     */
    public function away($away)
    {
        return $this->builder->where('away', $away);
    }


    /**
     * 过滤期号
     *
     * @param $issue
     * @return mixed
     */
    public function issue($issue)
    {
        return $this->builder->where('issue', $issue);
    }


    /**
     * 过滤序号
     *
     * @param $issueNum
     * @return mixed
     */
    public function issueNum($issueNum)
    {
        return $this->builder->where('issue_num', $issueNum);
    }


    /**
     * 过滤比赛时间
     *
     * @param $matchTime
     * @return mixed
     */
    public function matchTime($matchTime)
    {
        return $this->builder->where('match_time', $matchTime);
    }


    /**
     * 过滤销售状态码 顺序：胜平负,总进球,半全场,上下单双盘,比分 状态码：0-未开售、1-销售中、2-未知状态、3-已停售、4-已开奖
     *
     * @param $sellStatus
     * @return mixed
     */
    public function sellStatus($sellStatus)
    {
        return $this->builder->where('sell_status', $sellStatus);
    }


    /**
     * 过滤主队比分
     *
     * @param $homeScore
     * @return mixed
     */
    public function homeScore($homeScore)
    {
        return $this->builder->where('home_score', $homeScore);
    }


    /**
     * 过滤客队比分
     *
     * @param $awayScore
     * @return mixed
     */
    public function awayScore($awayScore)
    {
        return $this->builder->where('away_score', $awayScore);
    }


    /**
     * 过滤spf:胜平负 jq:进球 bqc:半全场 bf:比分 sxp:上下单双 sf:胜负
     *
     * @param $odds
     * @return mixed
     */
    public function odds($odds)
    {
        return $this->builder->where('odds', $odds);
    }


    /**
     * 过滤球类id，1-足球、2-篮球
     *
     * @param $sportId
     * @return mixed
     */
    public function sportId($sportId)
    {
        return $this->builder->where('sport_id', $sportId);
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

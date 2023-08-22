<?php
namespace app\model\filter;


use app\model\abstract\QueryFilter;


class LotteryJcResultFilter extends QueryFilter
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
     * 过滤体彩管理接口的比赛ID
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
     * 过滤赛事简称
     *
     * @param $shortComp
     * @return mixed
     */
    public function shortComp($shortComp)
    {
        return $this->builder->where('short_comp', $shortComp);
    }


    /**
     * 过滤主队简称
     *
     * @param $shortHome
     * @return mixed
     */
    public function shortHome($shortHome)
    {
        return $this->builder->where('short_home', $shortHome);
    }


    /**
     * 过滤客队简称
     *
     * @param $shortAway
     * @return mixed
     */
    public function shortAway($shortAway)
    {
        return $this->builder->where('short_away', $shortAway);
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
     * 过滤主队半场比分
     *
     * @param $halfHomeScore
     * @return mixed
     */
    public function halfHomeScore($halfHomeScore)
    {
        return $this->builder->where('half_home_score', $halfHomeScore);
    }


    /**
     * 过滤客队半场比分
     *
     * @param $halfAwayScore
     * @return mixed
     */
    public function halfAwayScore($halfAwayScore)
    {
        return $this->builder->where('half_away_score', $halfAwayScore);
    }


    /**
     * 过滤胜平负，顺序：结果,赔率；结果：3-主胜、1-平、0-客胜
     *
     * @param $spf
     * @return mixed
     */
    public function spf($spf)
    {
        return $this->builder->where('spf', $spf);
    }


    /**
     * 过滤让球胜平负，顺序：让球,结果,赔率；结果：3-主胜、1-平、0-客胜
     *
     * @param $rq
     * @return mixed
     */
    public function rq($rq)
    {
        return $this->builder->where('rq', $rq);
    }


    /**
     * 过滤比分，顺序：结果,赔率
     *
     * @param $bf
     * @return mixed
     */
    public function bf($bf)
    {
        return $this->builder->where('bf', $bf);
    }


    /**
     * 过滤进球，顺序：结果,赔率
     *
     * @param $jq
     * @return mixed
     */
    public function jq($jq)
    {
        return $this->builder->where('jq', $jq);
    }


    /**
     * 过滤半全场，顺序：半场结果,全场结果,赔率；结果：3-主胜、1-平、0-客胜
     *
     * @param $bqc
     * @return mixed
     */
    public function bqc($bqc)
    {
        return $this->builder->where('bqc', $bqc);
    }


    /**
     * 过滤胜负，顺序：结果,赔率；结果：3-主胜、0-客胜
     *
     * @param $sf
     * @return mixed
     */
    public function sf($sf)
    {
        return $this->builder->where('sf', $sf);
    }


    /**
     * 过滤让分胜负，顺序：让分,结果,赔率；结果：3-主胜、0-客胜
     *
     * @param $rf
     * @return mixed
     */
    public function rf($rf)
    {
        return $this->builder->where('rf', $rf);
    }


    /**
     * 过滤大小分，顺序：大小分,结果,赔率；结果：1-大分、0-小分
     *
     * @param $dxf
     * @return mixed
     */
    public function dxf($dxf)
    {
        return $this->builder->where('dxf', $dxf);
    }


    /**
     * 过滤胜分差，顺序：结果,赔率；结果1-6：客胜1-5、6-10、11-15、16-20、21-25、26+； 结果7-12：主胜1-5、6-10、11-15、16-20、21-25、26+
     *
     * @param $sfc
     * @return mixed
     */
    public function sfc($sfc)
    {
        return $this->builder->where('sfc', $sfc);
    }


    /**
     * 过滤jczq:竞彩足球  jclq:竞彩篮球
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

<?php

namespace app\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class LotteryBdResult
 * @package App\Models
 *
 * @property int $id
 * @property int $match_id
 * @property string $comp
 * @property string $home
 * @property string $away
 * @property int $issue
 * @property int $issue_num
 * @property int $match_time
 * @property string $sell_status
 * @property int $home_score
 * @property int $away_score
 * @property array $odds
 * @property int $sport_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class LotteryBdResult extends BaseModel
{
    use HasFactory, SoftDeletes;

    /**
     * 该表将与模型关联
     *
     * @var string
     */
    protected $table = 'lottery_bd_result';

    /**
     * 执行模型是否自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = true;


    /**
     * 属性转换
     *
     * @var array
     */
    protected $casts = [
         'odds' => 'array',
         'created_at' => 'datetime:Y-m-d H:i:s',
         'updated_at' => 'datetime:Y-m-d H:i:s',
         'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * 可以被批量赋值的属性
     *
     * @var array
     */
    protected $fillable = [
        'id', //
        'match_id', //唯一，用于和“体彩关联接口”中的比赛关联
        'comp', //赛事名称
        'home', //主队名称
        'away', //客队名称
        'issue', //期号
        'issue_num', //序号
        'match_time', //比赛时间
        'sell_status', //销售状态码 顺序：胜平负,总进球,半全场,上下单双盘,比分 状态码：0-未开售、1-销售中、2-未知状态、3-已停售、4-已开奖
        'home_score', //主队比分
        'away_score', //客队比分
        'odds', //spf:胜平负 jq:进球 bqc:半全场 bf:比分 sxp:上下单双 sf:胜负
        'sport_id', //球类id，1-足球、2-篮球
        'created_at', //
        'updated_at', //
        'deleted_at', //
    ];
}

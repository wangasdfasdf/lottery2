<?php

namespace app\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class LotteryJcResult
 * @package App\Models
 *
 * @property int $id
 * @property int $match_id
 * @property string $comp
 * @property string $home
 * @property string $away
 * @property string $short_comp
 * @property string $short_home
 * @property string $short_away
 * @property string $issue_num
 * @property int $match_time
 * @property int $home_score
 * @property int $away_score
 * @property int $half_home_score
 * @property int $half_away_score
 * @property string $spf
 * @property string $rq
 * @property string $bf
 * @property string $jq
 * @property string $bqc
 * @property string $sf
 * @property string $rf
 * @property string $dxf
 * @property string $sfc
 * @property string $type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class LotteryJcResult extends BaseModel
{
    use HasFactory, SoftDeletes;

    /**
     * 该表将与模型关联
     *
     * @var string
     */
    protected $table = 'lottery_jc_result';

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
        'match_id', //体彩管理接口的比赛ID
        'comp', //赛事名称
        'home', //主队名称
        'away', //客队名称
        'short_comp', //赛事简称
        'short_home', //主队简称
        'short_away', //客队简称
        'issue_num', //序号
        'match_time', //比赛时间
        'home_score', //主队比分
        'away_score', //客队比分
        'half_home_score', //主队半场比分
        'half_away_score', //客队半场比分
        'spf', //胜平负，顺序：结果,赔率；结果：3-主胜、1-平、0-客胜
        'rq', //让球胜平负，顺序：让球,结果,赔率；结果：3-主胜、1-平、0-客胜
        'bf', //比分，顺序：结果,赔率
        'jq', //进球，顺序：结果,赔率
        'bqc', //半全场，顺序：半场结果,全场结果,赔率；结果：3-主胜、1-平、0-客胜
        'sf', //胜负，顺序：结果,赔率；结果：3-主胜、0-客胜
        'rf', //让分胜负，顺序：让分,结果,赔率；结果：3-主胜、0-客胜
        'dxf', //大小分，顺序：大小分,结果,赔率；结果：1-大分、0-小分
        'sfc', //胜分差，顺序：结果,赔率；结果1-6：客胜1-5、6-10、11-15、16-20、21-25、26+； 结果7-12：主胜1-5、6-10、11-15、16-20、21-25、26+
        'type', //jczq:竞彩足球  jclq:竞彩篮球
        'created_at', //
        'updated_at', //
        'deleted_at', //
    ];
}

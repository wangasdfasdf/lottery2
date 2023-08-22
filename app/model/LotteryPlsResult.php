<?php

namespace app\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class LotteryPlsResult
 * @package App\Models
 *
 * @property int $id
 * @property int $issue
 * @property string $draw_result
 * @property float $amount1
 * @property float $amount2
 * @property float $amount3
 * @property int $kd
 * @property int $hz
 * @property int $type
 * @property array $result
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class LotteryPlsResult extends BaseModel
{
    use HasFactory, SoftDeletes;

    /**
     * 该表将与模型关联
     *
     * @var string
     */
    protected $table = 'lottery_pls_result';

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
         'result' => 'array',
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
        'issue', //彩票期号
        'draw_result', //开奖结果
        'amount1', //直选奖金
        'amount2', //组选3奖金
        'amount3', //组选6奖金
        'kd', //跨度值
        'hz', //和值
        'type', //1:组三类型  2:组六类型 3:豹子
        'result', //结果集
        'created_at', //
        'updated_at', //
        'deleted_at', //
    ];
}

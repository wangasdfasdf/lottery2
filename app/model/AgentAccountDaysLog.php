<?php

namespace app\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class AgentAccountDaysLog
 * @package App\Models
 *
 * @property int $id
 * @property int $agent_id
 * @property int $days
 * @property int $start_days
 * @property int $end_days
 * @property string $type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property array $other
 */
class AgentAccountDaysLog extends BaseModel
{
    use HasFactory, SoftDeletes;

    /**
     * 该表将与模型关联
     *
     * @var string
     */
    protected $table = 'agent_account_days_log';

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
         'other' => 'array',
    ];

    /**
     * 可以被批量赋值的属性
     *
     * @var array
     */
    protected $fillable = [
        'id', //
        'agent_id', //代理ID
        'days', //天数
        'start_days', //开始天数
        'end_days', //结束天数
        'type', //类型
        'created_at', //
        'updated_at', //
        'deleted_at', //
        'other', //
    ];
}

<?php

namespace app\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class Banner
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $jump_type
 * @property string $jump_value
 * @property int $status
 * @property Carbon $start_time
 * @property Carbon $end_time
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Banner extends BaseModel
{
    use HasFactory;

    /**
     * 该表将与模型关联
     *
     * @var string
     */
    protected $table = 'banner';

    /**
     * 执行模型是否自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * 日期转换
     *
     * @var string[]
     */
    protected $dates = [
         'start_time',
         'end_time',
         'created_at',
         'updated_at',
    ];

    /**
     * 属性转换
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * 可以被批量赋值的属性
     *
     * @var array
     */
    protected $fillable = [
        'id', //
        'name', //名称
        'url', //图片地址
        'jump_type', //跳转类型
        'jump_value', //跳转的值
        'status', //状态 1:启用 -1:禁用
        'start_time', //开始时间
        'end_time', //结束时间
        'created_at', //
        'updated_at', //
    ];
}

<?php

namespace app\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class Ad
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $position
 * @property string $image
 * @property string $status
 * @property Carbon $start_time
 * @property Carbon $end_time
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Ad extends BaseModel
{
    use HasFactory, SoftDeletes;

    /**
     * 该表将与模型关联
     *
     * @var string
     */
    protected $table = 'ad';

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
         'start_time' => 'datetime:Y-m-d H:i:s',
         'end_time' => 'datetime:Y-m-d H:i:s',
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
        'title', //名称
        'position', //位置
        'image', //图片
        'status', //状态
        'start_time', //开始时间
        'end_time', //结束时间
        'created_at', //
        'updated_at', //
        'deleted_at', //
    ];
}

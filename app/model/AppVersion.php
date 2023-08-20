<?php

namespace app\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class AppVersion
 * @package App\Models
 *
 * @property int $id
 * @property string $version
 * @property string $desc
 * @property string $download
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class AppVersion extends BaseModel
{
    use HasFactory;

    /**
     * 该表将与模型关联
     *
     * @var string
     */
    protected $table = 'app_version';

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
    ];

    /**
     * 可以被批量赋值的属性
     *
     * @var array
     */
    protected $fillable = [
        'id', //
        'version', //版本号
        'desc', //版本描述
        'download', //下载地址
        'created_at', //
        'updated_at', //
    ];
}

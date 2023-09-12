<?php

namespace app\model;

use app\enum\ConfigKey;
use app\service\OssService;
use app\service\RasService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class Config
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $key
 * @property string $value
 * @property string $desc
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Config extends BaseModel
{
    use HasFactory, SoftDeletes;

    /**
     * 该表将与模型关联
     *
     * @var string
     */
    protected $table = 'config';

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
        'name', //名称
        'key', //建
        'value', //值
        'desc', //描述
        'created_at', //
        'updated_at', //
        'deleted_at', //
    ];

    /**
     * 模型的“引导”方法。
     *
     * @return void
     */
    protected static function booted()
    {
        static::saved(function (Config $config) {
            if ($config->key == ConfigKey::DEFAULT_DOMAIN->value) {
                $object = 'machine/default-fc63d4503ad0da7d811b3db03b231fd6';
                $content = '{"domain":"' . $config->value . '"}';
                $content = RasService::instance()->privateEncode($content);
                OssService::instance()->put($object, $content);
            }
        });
    }
}

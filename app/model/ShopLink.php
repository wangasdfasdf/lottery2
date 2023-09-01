<?php

namespace app\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class ShopLink
 * @package App\Models
 *
 * @property int $id
 * @property int $agent_id
 * @property int $shop_id
 * @property string $name
 * @property string $phone
 * @property string $qq
 * @property string $wechat
 * @property string $note
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class ShopLink extends BaseModel
{
    use HasFactory, SoftDeletes;

    /**
     * 该表将与模型关联
     *
     * @var string
     */
    protected $table = 'shop_link';

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
        'agent_id', //代理Id
        'shop_id', //店铺ID
        'name', //姓名
        'phone', //电话
        'qq', //QQ
        'wechat', //wechat
        'note', //备注
        'created_at', //
        'updated_at', //
        'deleted_at', //
    ];
}

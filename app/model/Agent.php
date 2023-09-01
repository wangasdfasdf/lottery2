<?php

namespace app\model;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class Agent
 * @package App\Models
 *
 * @property int $id
 * @property string $login_name
 * @property string $password
 * @property string $name
 * @property string $avatar
 * @property string $token
 * @property string $status
 * @property string $tag
 * @property int $account_days
 * @property string $wallet_address_img
 * @property string $wallet_address
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Agent extends BaseModel
{
    use HasFactory, SoftDeletes;

    /**
     * 该表将与模型关联
     *
     * @var string
     */
    protected $table = 'agent';

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

    protected $hidden = [
        'deleted_at',
        'password',
    ];

    /**
     * 可以被批量赋值的属性
     *
     * @var array
     */
    protected $fillable = [
        'id', //
        'login_name', //登录名称
        'password', //登录密码
        'name', //昵称
        'avatar', //头像
        'token', //token
        'status', //状态 enable:启用 disable:禁用
        'created_at', //
        'updated_at', //
        'deleted_at', //
        'tag', //
        'account_days', //
        'wallet_address_img', //
        'wallet_address', //
    ];
}

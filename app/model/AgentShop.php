<?php

namespace app\model;

use app\model\traits\Suffix;
use app\traits\BinaryPermissions;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use support\Db;

/**
 * Class AgentShop
 * @package App\Models
 *
 * @property int $id
 * @property string $login_name
 * @property string $phone
 * @property string $password
 * @property string $name
 * @property string $status
 * @property Carbon $expiry_time
 * @property string $machine_id
 * @property int $is_history
 * @property int $print_type
 * @property string $order_prefix
 * @property string $address
 * @property string $bottom_code
 * @property int $role_history
 * @property int $role_current
 * @property int $is_open_online_pay
 * @property float $month_money
 * @property float $quarter_money
 * @property string $wallet_address
 * @property string $wallet_address_img
 * @property string $note
 * @property string $token
 * @property int $admin_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class AgentShop extends BaseModel
{
    use HasFactory, SoftDeletes, BinaryPermissions, Suffix;

    /**
     * 该表将与模型关联
     *
     * @var string
     */
    protected $table = 'agent_shop';

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
        'expiry_time' => 'datetime:Y-m-d H:i:s',
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
        'login_name', //登录名
        'phone', //联系电话
        'password', //登录密码
        'name', //名称
        'status', //1:启用 -1:禁用
        'expiry_time', //到期时间
        'machine_id', //机器编码
        'is_history', //1:有历史下单 -1:没有
        'print_type', //打印类型 1:广告版  2:地址版
        'order_prefix', //订单号前缀
        'address', //店铺地址
        'bottom_code', //底部编码
        'role_history', //历史权限
        'role_current', //本期权限
        'is_open_online_pay', //是否开通线上支付 -1:不开通 1:开通
        'month_money', //月付金额
        'quarter_money', //季付金额
        'wallet_address', //钱包地址
        'wallet_address_img', //钱包图片
        'note', //备注
        'token', //token
        'admin_id', //创建管理员ID
        'created_at', //
        'updated_at', //
        'deleted_at', //
    ];

    //往期篮球
    const ROLE_HISTORY_BASKETBALL = 1 << 0;
    //往期足球
    const ROLE_HISTORY_FOOTBALL = 1 << 1;
    //往期北单
    const ROLE_HISTORY_BJDC = 1 << 2;

    //本期北单
    const ROLE_CURRENT_BJDC = 1 << 0;
    //本期排三
    const ROLE_CURRENT_PLS = 1 << 1;

    protected $appends = ['is_role_history_basketball', 'is_role_history_football', 'is_role_history_bjdc', 'is_role_current_bjdc', 'is_role_current_pls'];

    public function isRoleHistoryBasketball(): Attribute
    {
        return new Attribute(
            get: fn($value, $attribute) => $this->has($attribute['role_history'] ?? 0, self::ROLE_HISTORY_BASKETBALL),
        );

    }

    public function isRoleHistoryFootball(): Attribute
    {
        return new Attribute(
            get: fn($value, $attribute) => $this->has($attribute['role_history'] ?? 0, self::ROLE_HISTORY_FOOTBALL),
        );

    }

    public function isRoleHistoryBjdc(): Attribute
    {
        return new Attribute(
            get: fn($value, $attribute) => $this->has($attribute['role_history'] ?? 0, self::ROLE_HISTORY_BJDC),
        );

    }

    public function isRoleCurrentBjdc(): Attribute
    {
        return new Attribute(
            get: fn($value, $attribute) => $this->has($attribute['role_current'] ?? 0, self::ROLE_CURRENT_BJDC),
        );

    }

    public function isRoleCurrentPls(): Attribute
    {
        return new Attribute(
            get: fn($value, $attribute) => $this->has($attribute['role_current'] ?? 0, self::ROLE_CURRENT_PLS),
        );

    }

    public function createTable($id): void
    {
        Db::statement(<<<AAA
CREATE TABLE `agent_shop_$id` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `login_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '登录名',
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '联系电话',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '登录密码',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '1:启用 -1:禁用',
  `expiry_time` timestamp NULL DEFAULT NULL COMMENT '到期时间',
  `machine_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '机器编码',
  `is_history` tinyint(4) NOT NULL DEFAULT '-1' COMMENT '1:有历史下单 -1:没有',
  `print_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '打印类型 1:广告版  2:地址版',
  `order_prefix` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '订单号前缀',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '店铺地址',
  `bottom_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '底部编码',
  `role_history` int(11) NOT NULL DEFAULT '0' COMMENT '历史权限',
  `role_current` int(11) NOT NULL DEFAULT '0' COMMENT '本期权限',
  `is_open_online_pay` tinyint(4) NOT NULL DEFAULT '-1' COMMENT '是否开通线上支付 -1:不开通 1:开通',
  `month_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '月付金额',
  `quarter_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '季付金额',
  `wallet_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '钱包地址',
  `wallet_address_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '钱包图片',
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '备注',
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'token',
  `admin_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '创建管理员ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='代理店铺_$id';
AAA
        );
    }

}

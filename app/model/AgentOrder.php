<?php

namespace app\model;

use app\model\traits\Suffix;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use support\Db;

/**
 * Class AgentOrder
 * @package App\Models
 *
 * @property int $id
 * @property int $shop_id
 * @property string $order_no
 * @property string $print_order_no
 * @property string $user_name
 * @property Carbon $create_time
 * @property string $status
 * @property string $betting_info
 * @property Carbon $plan_end_time
 * @property string $shop_name
 * @property string $shop_address
 * @property string $shop_link
 * @property string $pass_type
 * @property string $bet_number
 * @property string $bet_multiplier
 * @property string $bet_amount
 * @property string $pass_method
 * @property string $bet_type
 * @property array $bet_info
 * @property string $highest_reward
 * @property Carbon $print_time
 * @property array $detail
 * @property string $type
 * @property string $winning_status
 * @property float $wining_amount
 * @property float $original_wining_amount
 * @property int $is_past
 * @property string $serial_number
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class AgentOrder extends BaseModel
{
    use HasFactory, SoftDeletes, Suffix;

    /**
     * 该表将与模型关联
     *
     * @var string
     */
    protected $table = 'agent_order';

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
         'create_time' => 'datetime:Y-m-d H:i:s',
         'plan_end_time' => 'datetime:Y-m-d H:i:s',
         'bet_info' => 'array',
         'print_time' => 'datetime:Y-m-d H:i:s',
         'detail' => 'array',
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
        'shop_id', //店铺ID
        'order_no', //订单号
        'print_order_no', //打印订单号
        'user_name', //用户昵称
        'create_time', //下单时间
        'status', //状态
        'betting_info', //投注信息
        'plan_end_time', //方案截止时间
        'shop_name', //店铺名称
        'shop_address', //店铺地址
        'shop_link', //店铺联系方式
        'pass_type', //过关类型
        'bet_number', //注数
        'bet_multiplier', //投注倍数
        'bet_amount', //投注金额
        'pass_method', //过关方式
        'bet_type', //投注类型
        'bet_info', //投注信息
        'highest_reward', //最高奖励
        'print_time', //打印时间
        'detail', //投注信息(后端使用)
        'type', //football:足球 basketball:篮球
        'winning_status', //undrawn:未开奖，winning:中奖,not_won:未中奖
        'wining_amount', //中奖金额
        'is_past', //1是往期  2正常
        'serial_number', //序号
        'created_at', //
        'updated_at', //
        'deleted_at', //
        'original_wining_amount', //
    ];

    public function createTable(int $agent_id): void
    {
        Db::statement(<<<AAA
CREATE TABLE `agent_order_$agent_id` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '店铺ID',
  `order_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '订单号',
  `print_order_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '打印订单号',
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '用户昵称',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '下单时间',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '状态',
  `betting_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '投注信息',
  `plan_end_time` timestamp NULL DEFAULT NULL COMMENT '方案截止时间',
  `shop_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '店铺名称',
  `shop_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '店铺地址',
  `shop_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '店铺联系方式',
  `pass_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '过关类型',
  `bet_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '注数',
  `bet_multiplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '投注倍数',
  `bet_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '投注金额',
  `pass_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '过关方式',
  `bet_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '投注类型',
  `bet_info` json DEFAULT NULL COMMENT '投注信息',
  `highest_reward` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '最高奖励',
  `print_time` timestamp NULL DEFAULT NULL COMMENT '打印时间',
  `detail` json DEFAULT NULL COMMENT '投注信息(后端使用)',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'football:足球 basketball:篮球',
  `winning_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'undrawn' COMMENT 'undrawn:未开奖，winning:中奖,not_won:未中奖',
  `wining_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '中奖金额',
  `is_past` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1是往期  2正常',
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '序号',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `order_shop_id_index` (`shop_id`) USING BTREE,
  KEY `order_order_no_index` (`order_no`) USING BTREE,
  KEY `winning_status` (`winning_status`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='订单_$agent_id';
AAA
        );
    }


}

<?php

namespace app\model;

use app\model\traits\Suffix;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use support\Db;

/**
 * Class AgentShopExpiryTimeLog
 * @package App\Models
 *
 * @property int $id
 * @property int $shop_id
 * @property int $days
 * @property Carbon $start_expiry_time
 * @property Carbon $end_expiry_time
 * @property string $type
 * @property array $other
 */
class AgentShopExpiryTimeLog extends BaseModel
{
    use HasFactory, SoftDeletes, Suffix;

    /**
     * 该表将与模型关联
     *
     * @var string
     */
    protected $table = 'agent_shop_expiry_time_log';

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
         'start_expiry_time' => 'datetime:Y-m-d H:i:s',
         'end_expiry_time' => 'datetime:Y-m-d H:i:s',
         'other' => 'array',
    ];

    /**
     * 可以被批量赋值的属性
     *
     * @var array
     */
    protected $fillable = [
        'id', //
        'shop_id', //店铺id
        'days', //增加天数
        'start_expiry_time', //开始的到期时间
        'end_expiry_time', //结束的到期时间
        'type', //类型
        'other', //
    ];

    public function createTable($id): void
    {
        Db::statement(<<<AAA
CREATE TABLE `agent_shop_expiry_time_log_$id` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` bigint(20) DEFAULT NULL COMMENT '店铺id',
  `days` int(11) DEFAULT NULL COMMENT '增加天数',
  `start_expiry_time` datetime DEFAULT NULL COMMENT '开始的到期时间',
  `end_expiry_time` datetime DEFAULT NULL COMMENT '结束的到期时间',
  `type` varchar(255) COLLATE utf8mb4_german2_ci DEFAULT NULL COMMENT '类型',
  `other` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_id` (`shop_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci COMMENT='店铺到期记录_$id';
AAA
        );
    }
}

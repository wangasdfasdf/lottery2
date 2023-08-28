<?php

namespace app\model;

use app\model\traits\Suffix;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use support\Db;

/**
 * Class AgentShopWalletPaymentLog
 * @package App\Models
 *
 * @property int $id
 * @property int $shop_id
 * @property string $shop_name
 * @property int $amount
 * @property string $transfer_time
 * @property string $from_address
 * @property string $to_address
 * @property string $type
 * @property string $transaction_id
 * @property array $result
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class AgentShopWalletPaymentLog extends BaseModel
{
    use HasFactory, SoftDeletes, Suffix;

    /**
     * 该表将与模型关联
     *
     * @var string
     */
    protected $table = 'agent_shop_wallet_payment_log';

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
         'result' => 'array',
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
        'shop_name', //店铺名称
        'amount', //转账金额
        'transfer_time', //转账时间
        'from_address', //转账账户
        'to_address', //收款账户
        'type', //转账方式(月卡/季卡)
        'transaction_id', //交易单号
        'result', //交易信息
        'created_at', //
        'updated_at', //
        'deleted_at', //
    ];


    public function createTable($id): void
    {
        Db::statement(<<<AAA
CREATE TABLE `agent_shop_wallet_payment_log_$id` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '店铺ID',
  `shop_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '店铺名称',
  `amount` decimal(65,0) unsigned NOT NULL DEFAULT '0' COMMENT '转账金额',
  `transfer_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '转账时间',
  `from_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '转账账户',
  `to_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '收款账户',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '转账方式(月卡/季卡)',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '交易单号',
  `result` json DEFAULT NULL COMMENT '交易信息',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `shop_id` (`shop_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='代理店铺转U记录_$id';
AAA
        );
    }

}

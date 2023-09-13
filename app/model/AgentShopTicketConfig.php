<?php

namespace app\model;

use app\model\traits\Suffix;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use support\Db;

/**
 * Class AgentShopTicketConfig
 * @package App\Models
 *
 * @property int $id
 * @property int $shop_id
 * @property string $order_prefix
 * @property string $address
 * @property string $print_type
 * @property string $bottom_code
 * @property string $qr_code
 * @property string $type
 * @property array $ad_content
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class AgentShopTicketConfig extends BaseModel
{
    use HasFactory, SoftDeletes, Suffix;

    /**
     * 该表将与模型关联
     *
     * @var string
     */
    protected $table = 'agent_shop_ticket_config';

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
         'ad_content' => 'array',
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
        'order_prefix', //订单号前缀
        'address', //店铺地址
        'print_type', //ad:广告版  address:地址版
        'bottom_code', //地板编码
        'qr_code', //二维码
        'ad_content', //广告内容
        'ad_content2', //广告内容
        'created_at', //
        'updated_at', //
        'deleted_at', //
        'type', //
    ];


    public function createTable($id): void
    {
        Db::statement(<<<AAA
CREATE TABLE `agent_shop_ticket_config_$id` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '店铺ID',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '类型 jc:竞彩 pls:排列三 bd:北单',
  `order_prefix` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '订单号前缀',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '店铺地址',
  `print_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'ad:广告版  address:地址版',
  `bottom_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '地板编码',
  `qr_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '二维码',
  `ad_content` json DEFAULT NULL COMMENT '广告内容',
  `ad_content2` json DEFAULT NULL COMMENT '广告内容2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='代理票面设置_$id';
AAA
        );
    }
}

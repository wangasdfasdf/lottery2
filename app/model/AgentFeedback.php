<?php

namespace app\model;

use app\model\traits\Suffix;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use support\Db;

/**
 * Class Feedback
 * @package App\Models
 *
 * @property int $id
 * @property int $shop_id
 * @property string $problem
 * @property string $reply
 * @property Carbon $reply_time
 * @property int $is_read
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class AgentFeedback extends BaseModel
{
    use HasFactory, SoftDeletes, Suffix;

    /**
     * 该表将与模型关联
     *
     * @var string
     */
    protected $table = 'agent_feedback';

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
         'reply_time' => 'datetime:Y-m-d H:i:s',
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
        'problem', //问题
        'reply', //回复
        'reply_time', //回复时间
        'is_read', //-1:未读  1:已读
        'created_at', //
        'updated_at', //
        'deleted_at', //
    ];

    public function createTable(int $agent_id): void
    {
        Db::statement(<<<AAA
CREATE TABLE `agent_feedback_$agent_id` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '店铺ID',
  `problem` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '问题',
  `reply` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '回复',
  `reply_time` timestamp NULL DEFAULT NULL COMMENT '回复时间',
  `is_read` tinyint(4) NOT NULL DEFAULT '-1' COMMENT '-1:未读  1:已读',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='问题反馈_$agent_id';
AAA
        );
    }

    public function shop()
    {
        return $this->belongsTo(AgentShop::class)->select('id', 'login_name', 'phone', 'name');
    }
}

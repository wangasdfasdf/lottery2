<?php

namespace app\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class AgentWalletPaymentLog
 * @package App\Models
 *
 * @property int $id
 * @property int $agent_id
 * @property string $agent_name
 * @property int $amount
 * @property string $transfer_time
 * @property string $from_address
 * @property string $to_address
 * @property string $transaction_id
 * @property array $result
 * @property int $days
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class AgentWalletPaymentLog extends BaseModel
{
    use HasFactory, SoftDeletes;

    /**
     * 该表将与模型关联
     *
     * @var string
     */
    protected $table = 'agent_wallet_payment_log';

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
        'agent_id', //代理ID
        'agent_name', //代理名称
        'amount', //转账金额
        'transfer_time', //转账时间
        'from_address', //转账账户
        'to_address', //收款账户
        'transaction_id', //交易单号
        'result', //交易信息
        'created_at', //
        'updated_at', //
        'deleted_at', //
        'days', //
    ];
}

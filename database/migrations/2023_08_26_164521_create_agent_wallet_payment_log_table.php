<?php

use Illuminate\Database\Schema\Blueprint;
use Eloquent\Migrations\Migrations\Migration;
use support\Db;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->schema()->create('agent_wallet_payment_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id')->default(0)->comment('代理ID')->index();
            $table->string('agent_name')->default('')->comment('代理名称');
            $table->decimal('amount', 65, 0)->default(0)->comment('转账金额');
            $table->string('transfer_time')->default('')->comment('转账时间');
            $table->string('from_address')->default('')->comment('转账账户');
            $table->string('to_address')->default('')->comment('收款账户');
            $table->string('transaction_id')->default('')->comment('交易单号');
            $table->decimal('days', 10, 2)->default(0)->comment('天数');
            $table->json('result')->nullable()->comment('交易信息');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `agent_wallet_payment_log` comment '代理充值日志'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('agent_wallet_payment_log');
    }
};

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
        $this->schema()->create('agent_account_days_log', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('agent_id')->default(0)->comment('代理ID');
            $table->decimal('days',10, 2)->default(0)->comment('天数');
            $table->decimal('start_days', 10, 2)->default(0)->comment('开始天数');
            $table->decimal('end_days', 10, 2)->default(0)->comment('结束天数');
            $table->string('type')->default(0)->comment('类型');
            $table->json('other')->nullable()->comment('其他');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `agent_account_days_log` comment '代理余额天数日志'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('agent_account_days_log');
    }
};

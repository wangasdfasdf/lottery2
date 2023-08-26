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
        $this->schema()->create('agent', function (Blueprint $table) {
            $table->id();
            $table->string('login_name')->default('')->comment('登录名称');
            $table->string('password')->default('')->comment('登录密码');
            $table->string('name')->default('')->comment('昵称');
            $table->string('avatar')->default('')->comment('头像');
            $table->string('token')->default('')->comment('token');
            $table->decimal('account_days', 10,2)->default(0)->comment('账户天数');
            $table->string('tag')->default('')->comment('账户天数');
            $table->string('status')->default('enable')->comment('状态 enable:启用 disable:禁用');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `agent` comment '代理'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('agent');
    }
};

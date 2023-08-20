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
        $this->schema()->create('admin_user', function (Blueprint $table) {
            $table->id();
            $table->string('login_name')->default('')->comment('登录名称');
            $table->string('password')->default('')->comment('登录密码');
            $table->string('name')->default('')->comment('昵称');
            $table->string('avatar')->default('')->comment('头像');
            $table->string('token')->default('')->comment('token');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `admin_user` comment '后台用户'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('admin_user');
    }
};

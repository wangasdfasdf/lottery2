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
        $this->schema()->create('ad', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('')->comment('名称');
            $table->string('position')->default('')->comment('位置');
            $table->string('image')->default('')->comment('图片');
            $table->string('status')->default('')->comment('状态');
            $table->dateTime('start_time')->nullable()->comment('开始时间');
            $table->dateTime('end_time')->nullable()->comment('结束时间');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `ad` comment '广告'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('ad');
    }
};

<?php

use Illuminate\Database\Schema\Blueprint;
use Eloquent\Migrations\Migrations\Migration;
use support\Db;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       $this->schema()->create('app_version', function (Blueprint $table) {
           $table->id();
           $table->string('version')->default('')->comment('版本号');
           $table->string('desc')->default('')->comment('版本描述');
           $table->string('download')->default('')->comment('下载地址');
           $table->timestamps();
        });

       DB::statement("ALTER TABLE `app_version` comment '版本管理'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('app_version');
    }
};

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
       $this->schema()->create('config', function (Blueprint $table) {
           $table->id();
           $table->string('name')->default('')->comment('名称');
           $table->string('key')->default('')->comment('建');
           $table->text('value')->nullable()->comment('值');
           $table->string('desc')->default('')->comment('描述');
           $table->timestamps();
           $table->softDeletes();
        });

       DB::statement("ALTER TABLE `config` comment '平台配置'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('config');
    }
};

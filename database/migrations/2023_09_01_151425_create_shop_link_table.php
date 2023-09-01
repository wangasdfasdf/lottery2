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
       $this->schema()->create('shop_link', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('agent_id')->default(0)->comment('代理Id');
           $table->unsignedBigInteger('shop_id')->default(0)->comment('店铺ID');
           $table->string('name')->default('')->comment('姓名');
           $table->string('phone')->default('')->comment('电话');
           $table->string('qq')->default('')->comment('QQ');
           $table->string('wechat')->default('')->comment('wechat');
           $table->string('note')->default('')->comment('备注');
           $table->timestamps();
           $table->softDeletes();
        });

       DB::statement("ALTER TABLE `shop_link` comment '店铺联系'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('shop_link');
    }
};

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
       $this->schema()->create('lottery_pls_result', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('issue')->default(0)->comment('彩票期号')->index();
           $table->string('draw_result')->default('')->comment('开奖结果');
           $table->decimal('amount1')->default(0.00)->comment('直选奖金');
           $table->decimal('amount2')->default(0.00)->comment('组选3奖金');
           $table->decimal('amount3')->default(0.00)->comment('组选6奖金');
           $table->tinyInteger('kd')->default(0)->comment('跨度值');
           $table->tinyInteger('hz')->default(0)->comment('和值');
           $table->tinyInteger('type')->default(0)->comment('1:组三类型  2:组六类型 3:豹子');
           $table->json('result')->nullable()->comment('结果集');
           $table->timestamps();
           $table->softDeletes();
        });

       DB::statement("ALTER TABLE `lottery_pls_result` comment '排列三开奖结果'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('lottery_pls_result');
    }
};

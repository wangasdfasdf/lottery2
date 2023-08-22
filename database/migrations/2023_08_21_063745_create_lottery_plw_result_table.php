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
       $this->schema()->create('lottery_plw_result', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('issue')->default(0)->comment('彩票期号')->index();
           $table->string('draw_result')->default('')->comment('开奖结果');
           $table->decimal('amount')->default(0.00)->comment('直选奖金');
           $table->json('result')->nullable()->comment('结果集');
           $table->timestamps();
           $table->softDeletes();
        });

       DB::statement("ALTER TABLE `lottery_plw_result` comment '排列五开奖结果'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('lottery_plw_result');
    }
};

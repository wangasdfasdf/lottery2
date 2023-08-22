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
       $this->schema()->create('lottery_bd_sf_result', function (Blueprint $table) {
           $table->id();
           $table->integer('match_id')->default(0)->comment('唯一，用于和“体彩关联接口”中的比赛关联')->index();
           $table->string('comp')->default('')->comment('赛事名称');
           $table->string('home')->default('')->comment('主队名称');
           $table->string('away')->default('')->comment('客队名称');
           $table->integer('issue')->default(0)->comment('期号');
           $table->integer('issue_num')->default(0)->comment('序号');
           $table->integer('match_time')->default(0)->comment('比赛时间');
           $table->string('sell_status')->default('')->comment('销售状态码 顺序：胜平负,总进球,半全场,上下单双盘,比分 状态码：0-未开售、1-销售中、2-未知状态、3-已停售、4-已开奖');
           $table->integer('home_score')->default(0)->comment('主队比分');
           $table->integer('away_score')->default(0)->comment('客队比分');
           $table->json('odds')->nullable()->comment('spf:胜平负 jq:进球 bqc:半全场 bf:比分 sxp:上下单双 sf:胜负');
           $table->tinyInteger('sport_id')->default(0)->comment('球类id，1-足球、2-篮球');
           $table->timestamps();
           $table->softDeletes();

           $table->index(['issue', 'issue_num']);
        });

       DB::statement("ALTER TABLE `lottery_bd_sf_result` comment '北单胜负开奖结果'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('lottery_bd_sf_result');
    }
};

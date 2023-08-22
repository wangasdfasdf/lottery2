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
       $this->schema()->create('lottery_jc_result', function (Blueprint $table) {
           $table->id();
           $table->integer('match_id')->default(0)->comment('体彩管理接口的比赛ID');
           $table->string('comp')->default('')->comment('赛事名称');
           $table->string('home')->default('')->comment('主队名称');
           $table->string('away')->default('')->comment('客队名称');
           $table->string('short_comp')->default('')->comment('赛事简称');
           $table->string('short_home')->default('')->comment('主队简称');
           $table->string('short_away')->default('')->comment('客队简称');
           $table->string('issue_num')->default('')->comment('序号');
           $table->integer('match_time')->default(0)->comment('比赛时间');
           $table->integer('home_score')->default(0)->comment('主队比分');
           $table->integer('away_score')->default(0)->comment('客队比分');
           $table->integer('half_home_score')->default(0)->comment('主队半场比分');
           $table->integer('half_away_score')->default(0)->comment('客队半场比分');
           $table->string('spf')->default('')->comment('胜平负，顺序：结果,赔率；结果：3-主胜、1-平、0-客胜');
           $table->string('rq')->default('')->comment('让球胜平负，顺序：让球,结果,赔率；结果：3-主胜、1-平、0-客胜');
           $table->string('bf')->default('')->comment('比分，顺序：结果,赔率');
           $table->string('jq')->default('')->comment('进球，顺序：结果,赔率');
           $table->string('bqc')->default('')->comment('半全场，顺序：半场结果,全场结果,赔率；结果：3-主胜、1-平、0-客胜');
           $table->string('sf')->default('')->comment('胜负，顺序：结果,赔率；结果：3-主胜、0-客胜');
           $table->string('rf')->default('')->comment('让分胜负，顺序：让分,结果,赔率；结果：3-主胜、0-客胜');
           $table->string('dxf')->default('')->comment('大小分，顺序：大小分,结果,赔率；结果：1-大分、0-小分');
           $table->string('sfc')->default('')->comment('胜分差，顺序：结果,赔率；结果1-6：客胜1-5、6-10、11-15、16-20、21-25、26+； 结果7-12：主胜1-5、6-10、11-15、16-20、21-25、26+');
           $table->string('type')->default('')->comment('jczq:竞彩足球  jclq:竞彩篮球');
           $table->timestamps();
           $table->softDeletes();

           $table->index(['match_id', 'type']);
        });

       DB::statement("ALTER TABLE `lottery_jc_result` comment '竞彩比赛开奖结果'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('lottery_jc_result');
    }
};

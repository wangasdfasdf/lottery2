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
       $this->schema()->table('agent_account_days_log', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->default(0)->comment('店铺id')->after('agent_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->table('agent_account_days_log', function (Blueprint $table) {
            $table->dropColumn('shop_id');
        });
    }
};

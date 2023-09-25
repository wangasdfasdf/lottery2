<?php

use Illuminate\Database\Schema\Blueprint;
use Eloquent\Migrations\Migrations\Migration;

return new class extends Migration
{
    /**
     * Enables, if supported, wrapping the migration within a transaction.
     */
    //public bool $withinTransaction = false;
    // Un comment if you want the migration not to run inside a transaction

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $ids = \app\model\Agent::query()->pluck('id');

        foreach ($ids as $id){
            $this->schema()->table('agent_order_'.$id, function (Blueprint $table) {
                $table->decimal('original_wining_amount', 20,2)->default(0)->comment('原中奖金额')->after('wining_amount');
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->table('agent_order_1', function (Blueprint $table) {
            //
        });
    }
};

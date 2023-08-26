<?php

use Illuminate\Database\Schema\Blueprint;
use Eloquent\Migrations\Migrations\Migration;

return new class extends Migration {
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
        $this->schema()->table('agent', function (Blueprint $table) {
            $table->string('wallet_address')->default('')->comment('支付的钱包地址')->after('status');
            $table->string('wallet_address_img')->default('')->comment('支付的钱包地址图片')->after('wallet_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->table('agent', function (Blueprint $table) {
            $table->dropColumn('wallet_address');
            $table->dropColumn('wallet_address_img');
        });
    }
};

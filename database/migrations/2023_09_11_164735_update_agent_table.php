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
            $table->string('client_url')->comment('客户端下载地址')->default('')->after('tag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->table('agent', function (Blueprint $table) {
            $table->dropColumn('client_url');
        });
    }
};

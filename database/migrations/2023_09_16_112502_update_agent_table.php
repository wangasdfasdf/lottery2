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
        $this->schema()->table('agent', function (Blueprint $table) {
            $table->decimal('u2day', 10, 4)->default(0)->comment('u转天')->after('domains');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->table('agent', function (Blueprint $table) {
            $table->dropColumn('u2day');
        });
    }
};

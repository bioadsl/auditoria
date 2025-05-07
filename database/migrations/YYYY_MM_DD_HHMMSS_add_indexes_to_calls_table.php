<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('calls', function (Blueprint $table) {
            $table->index('client_id');
            $table->index('agent_id');
            $table->index('server_id');
            $table->index('call_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calls', function (Blueprint $table) {
            $table->dropIndex(['client_id']);
            $table->dropIndex(['agent_id']);
            $table->dropIndex(['server_id']);
            $table->dropIndex(['call_date']);
        });
    }
};
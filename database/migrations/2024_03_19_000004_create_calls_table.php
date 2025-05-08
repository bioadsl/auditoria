<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('agent_id')->constrained();
            $table->foreignId('server_id')->nullable()->constrained();
            $table->string('ticket_number')->nullable();
            $table->foreignId('action_type_id')->constrained();
            $table->foreignId('final_status_id')->constrained();
            $table->foreignId('call_result_id')->constrained();
            $table->datetime('call_date');
            $table->boolean('remote_access')->default(false);
            $table->foreignId('problem_description_id')->constrained();
            $table->text('observation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};
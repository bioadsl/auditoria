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
        if (!Schema::hasTable('calls')) {
                Schema::create('calls', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('agent_id');
                $table->unsignedBigInteger('client_id');
                $table->unsignedBigInteger('server_id')->nullable();
                $table->unsignedBigInteger('action_type_id');
                $table->unsignedBigInteger('final_status_id');
                $table->unsignedBigInteger('call_result_id');
                $table->unsignedBigInteger('problem_description_id')->nullable();
                $table->string('ticket_number')->nullable();
                $table->string('user_name')->nullable(); // Nome do usuário atendido como campo informativo
                $table->text('observation')->nullable();
                $table->integer('wait_time')->default(0);
                $table->boolean('remote_access')->default(false);
                $table->dateTime('call_date');
                $table->timestamps();

                // Foreign keys
                $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
                $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
                $table->foreign('server_id')->references('id')->on('servers')->onDelete('set null');
                $table->foreign('action_type_id')->references('id')->on('action_types')->onDelete('restrict');
                $table->foreign('final_status_id')->references('id')->on('final_statuses')->onDelete('restrict');
                $table->foreign('call_result_id')->references('id')->on('call_results')->onDelete('restrict');
                $table->foreign('problem_description_id')->references('id')->on('problem_descriptions')->onDelete('set null');
            });
        }    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};
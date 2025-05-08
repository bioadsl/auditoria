<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('client_id')->constrained();
            $table->timestamps();
        });

        Schema::create('action_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('final_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('call_results', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('problem_descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('problem_descriptions');
        Schema::dropIfExists('call_results');
        Schema::dropIfExists('final_statuses');
        Schema::dropIfExists('action_types');
        Schema::dropIfExists('servers');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Create servers table
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('client_id')->constrained();
            $table->timestamps();
        });

        // Create action_types table
        Schema::create('action_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Create final_statuses table
        Schema::create('final_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Create call_results table
        Schema::create('call_results', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Create problem_descriptions table
        Schema::create('problem_descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('category')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('problem_descriptions');
        Schema::dropIfExists('call_results');
        Schema::dropIfExists('final_statuses');
        Schema::dropIfExists('action_types');
        Schema::dropIfExists('servers');
    }
};
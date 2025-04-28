<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('problem_descriptions')) {
            Schema::create('problem_descriptions', function (Blueprint $table) {
                $table->id();
                $table->string('description')->unique();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('problem_descriptions');
    }
};
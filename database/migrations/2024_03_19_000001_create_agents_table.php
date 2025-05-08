<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('agents')) {
            Schema::create('agents', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('name');
                $table->timestamps();
                // Falta a coluna 'active'
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('final_statuses')) {
                Schema::create('final_statuses', function (Blueprint $table) {        
                $table->id();
                $table->string('name')->unique();
                $table->timestamps();
            });
        }
    }
    public function down(): void
    {
        Schema::dropIfExists('final_statuses');
    }
}; 
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
        if (!Schema::hasTable('usr')) {
            Schema::create('usr', function (Blueprint $table) {  
                $table->id();
                $table->string('name');
                $table->string('department')->nullable();
                $table->unsignedBigInteger('client_id');
                $table->timestamps();
                $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usr');
    }
};
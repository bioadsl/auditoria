<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalStatusesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('final_statuses')) {
            Schema::create('final_statuses', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('final_statuses');
    }
}
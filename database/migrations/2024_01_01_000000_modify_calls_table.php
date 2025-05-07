<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCallsTable extends Migration
{
    public function up()
    {
        Schema::table('calls', function (Blueprint $table) {
            // Remover as chaves estrangeiras existentes
            $table->dropForeign(['server_id']);
            $table->dropForeign(['problem_description_id']);
            
            // Remover as colunas antigas
            $table->dropColumn('server_id');
            $table->dropColumn('problem_description_id');
            
            // Adicionar novos campos
            $table->string('server_name')->nullable()->after('client_id');
            $table->text('observation')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('calls', function (Blueprint $table) {
            $table->bigInteger('server_id')->unsigned()->nullable();
            $table->bigInteger('problem_description_id')->unsigned()->nullable();
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('set null');
            $table->foreign('problem_description_id')->references('id')->on('problem_descriptions')->onDelete('set null');
            $table->dropColumn('server_name');
        });
    }
}
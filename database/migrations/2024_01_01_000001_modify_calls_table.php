<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('calls', function (Blueprint $table) {
            // Primeiro, vamos verificar se as chaves estrangeiras existem antes de tentar removê-las
            if (Schema::hasColumn('calls', 'server_id')) {
                $table->dropForeign(['server_id']);
                $table->dropColumn('server_id');
            }
            
            if (Schema::hasColumn('calls', 'problem_description_id')) {
                $table->dropForeign(['problem_description_id']);
                $table->dropColumn('problem_description_id');
            }
            
            // Adicionar novos campos
            if (!Schema::hasColumn('calls', 'server_name')) {
                $table->string('server_name')->nullable()->after('client_id');
            }
            
            // Modificar campo observation
            if (Schema::hasColumn('calls', 'observation')) {
                $table->text('observation')->nullable()->change();
            }
        });
    }

    public function down()
    {
        Schema::table('calls', function (Blueprint $table) {
            // Reverter as alterações
            if (Schema::hasColumn('calls', 'server_name')) {
                $table->dropColumn('server_name');
            }
            
            if (!Schema::hasColumn('calls', 'server_id')) {
                $table->bigInteger('server_id')->unsigned()->nullable();
                $table->foreign('server_id')->references('id')->on('servers')->onDelete('set null');
            }
            
            if (!Schema::hasColumn('calls', 'problem_description_id')) {
                $table->bigInteger('problem_description_id')->unsigned()->nullable();
                $table->foreign('problem_description_id')->references('id')->on('problem_descriptions')->onDelete('set null');
            }
        });
    }
};
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actionTypes = [
            ['name' => 'Sem Ação'],
            ['name' => 'Incompleta'],
            ['name' => 'Informação'],
            ['name' => 'Abertura'],
            ['name' => 'Corretiva'],
            ['name' => 'Engano'],
            ['name' => 'Teste'],
            ['name' => 'Cancelamento'],
            ['name' => 'Encaminhamento N2'],
            ['name' => 'Encaminhamento N3'],
        ];

        DB::table('action_types')->insert($actionTypes);
    }
}
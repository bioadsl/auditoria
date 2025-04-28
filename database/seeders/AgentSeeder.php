<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    public function run(): void
    {
        $agents = [
            ['code' => '400501', 'name' => 'Jhuanmontalvão'],
            ['code' => '400426', 'name' => 'Alyane Silva'],
            ['code' => '400403', 'name' => 'Paulo Henrique Ribeiro Da Silva'],
            ['code' => '400402', 'name' => 'Nycollas Martins'],
            ['code' => '400423', 'name' => 'Hugo Rocha'],
            ['code' => '400425', 'name' => 'Debora Oliveira'],
            ['code' => '400405', 'name' => 'Samara Rodrigues'],
            ['code' => '400422', 'name' => 'Denys Oliveira'],
            ['code' => '400424', 'name' => 'Raissa Sousa'],
            ['code' => '400427', 'name' => 'Vicente Neto'],
            ['code' => '400401', 'name' => 'Teddy Rodrigues'],
            ['code' => '400502', 'name' => 'Matheus Vieira'],
            ['code' => '400503', 'name' => 'Eduardo Rodrigues'],
            ['code' => '400504', 'name' => 'Adeilson Alves'],
            ['code' => '400421', 'name' => 'Matheus Accioly'],
            ['code' => '400413', 'name' => 'Matheus Henrique'],
            ['code' => '400418', 'name' => 'Leandro Souza'],
            ['code' => '400417', 'name' => 'Breno Marques'],
            ['code' => '400416', 'name' => 'Adalberto Filho'],
        ];

        foreach ($agents as $agent) {
            Agent::updateOrCreate(
                ['code' => $agent['code']],
                ['name' => $agent['name']]
            );
        }
    }
}
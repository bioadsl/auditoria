<?php

namespace Database\Seeders;

use App\Models\Usr;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'João Silva', 'department' => 'TI', 'client_id' => 1],
            ['name' => 'Maria Santos', 'department' => 'RH', 'client_id' => 1],
            ['name' => 'Pedro Oliveira', 'department' => 'Financeiro', 'client_id' => 2],
            ['name' => 'Ana Costa', 'department' => 'Administrativo', 'client_id' => 2],
            ['name' => 'Carlos Souza', 'department' => 'TI', 'client_id' => 3],
            ['name' => 'Juliana Lima', 'department' => 'RH', 'client_id' => 3],
            ['name' => 'Roberto Alves', 'department' => 'Financeiro', 'client_id' => 4],
            ['name' => 'Fernanda Martins', 'department' => 'Administrativo', 'client_id' => 4],
        ];

        foreach ($users as $user) {
            Usr::create($user);
        }
    }
} 
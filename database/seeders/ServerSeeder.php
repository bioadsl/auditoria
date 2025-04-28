<?php

namespace Database\Seeders;

use App\Models\Server;
use Illuminate\Database\Seeder;

class ServerSeeder extends Seeder
{
    public function run(): void
    {
        $servers = [
            ['name' => 'Servidor 1', 'department' => 'TI', 'client_id' => 1],
            ['name' => 'Servidor 2', 'department' => 'TI', 'client_id' => 1],
            ['name' => 'Servidor 3', 'department' => 'TI', 'client_id' => 2],
            ['name' => 'Servidor 4', 'department' => 'TI', 'client_id' => 2],
        ];

        foreach ($servers as $server) {
            Server::create($server);
        }
    }
} 
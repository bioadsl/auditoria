<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            ['name' => 'ANA'],
            ['name' => 'TRE-CE'],
            ['name' => 'SGG'],
            ['name' => 'MRE'],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
} 
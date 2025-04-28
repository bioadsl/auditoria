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
        DB::table('action_types')->insert([
            ['name' => 'Create', 'description' => 'Action to create a new record'],
            ['name' => 'Update', 'description' => 'Action to update an existing record'],
            ['name' => 'Delete', 'description' => 'Action to delete a record'],
            // Add more action types as needed
        ]);
    }
}
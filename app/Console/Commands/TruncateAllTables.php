<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TruncateAllTables extends Command
{
    protected $signature = 'db:truncate-all';
    protected $description = 'Truncate all tables in the database';

    public function handle()
    {
        if (!$this->confirm('Are you sure you want to truncate all tables? This cannot be undone!')) {
            $this->info('Operation cancelled.');
            return;
        }

        $this->info('Truncating all tables...');

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $tables = [
            'calls',
            'agents',
            'clients',
            'users',
            'servers',
            'jobs',
            'cache'
        ];

        foreach ($tables as $table) {
            DB::table($table)->truncate();
            $this->info("Table {$table} truncated.");
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->info('All tables have been truncated successfully!');
    }
} 
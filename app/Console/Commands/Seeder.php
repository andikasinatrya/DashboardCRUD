<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Seeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
     $this->info('Seeding User...');
     $this->call('db:seed', ['--class' => 'Database\\Seeders\\DatabaseSeeder']);
     $this->info('Seeder User completed.');
    }
}

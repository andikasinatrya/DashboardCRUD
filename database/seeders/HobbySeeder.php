<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('hobbies')->insert([
            ['name' => 'Bermain Bola'],
            ['name' => 'Bermain Game'],
            ['name' => 'Bermain Ep Ep'],
            ['name' => 'Bermain Mobile Legend'],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TelephonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Pastikan ada person dengan ID 1
        $person = \App\Models\Person::first(); // Ambil data person pertama
    
        // Jika person ditemukan, masukkan telepon
        if ($person) {
            DB::table('telephones')->insert([
                ['person_id' => $person->id, 'telephone_number' => '08123456789'],
                ['person_id' => $person->id, 'telephone_number' => '08234567890'],
            ]);
        } else {
            // Jika tidak ada person, buat data person terlebih dahulu
            $person = \App\Models\Person::create([
                'name' => 'John Doe', // Sesuaikan dengan data yang diperlukan
            ]);
    
            DB::table('telephones')->insert([
                ['person_id' => $person->id, 'telephone_number' => '08123456789'],
                ['person_id' => $person->id, 'telephone_number' => '08234567890'],
            ]);
        }
    }
    

}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NisnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Misalnya kamu ingin menambahkan nisn untuk person dengan ID 1
        $personId = 1;
    
        // Cek apakah sudah ada nisn untuk person_id yang sama
        $existingNisn = DB::table('nisns')->where('person_id', $personId)->exists();
    
        if (!$existingNisn) {
            // Jika belum ada, insert nisn baru untuk person_id tersebut
            DB::table('nisns')->insert([
                ['nisn' => '1234567890', 'person_id' => $personId],
                ['nisn' => '0987654321', 'person_id' => $personId],
            ]);
        } else {
            // Jika sudah ada, tampilkan pesan atau lanjutkan dengan logika lain
            $this->info("NISN untuk person_id {$personId} sudah ada.");
        }
    }
    
}

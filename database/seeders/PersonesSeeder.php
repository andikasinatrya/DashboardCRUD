<?php

namespace Database\Seeders;

use App\Models\Nisn;
use App\Models\Hobby;
use App\Models\Person;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PersonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Membuat data untuk nisn
        $nisn = Nisn::create(['nisn' => '1234567890']);

        // Membuat data untuk person dan menghubungkannya dengan nisn
        $person = Person::create([
            'name' => 'John Doe',
            'nisn_id' => $nisn->id, // Menghubungkan person dengan nisn
        ]);

        // Menghubungkan person dengan hobbies (many-to-many)
        $hobbies = Hobby::whereIn('hobby', ['Bermain Bola', 'Bermain Game'])->get(); // Misalnya dari data seeding
        $person->hobbies()->attach($hobbies->pluck('id'));

        // Menambahkan telepon untuk person (one-to-many)
        $telephones = [
            ['phone_number' => '08123456789'],
            ['phone_number' => '08234567890'],
        ];
        $person->telephones()->createMany($telephones); // Menambahkan telepon
    }
    
}

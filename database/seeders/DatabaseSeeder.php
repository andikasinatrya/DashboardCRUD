<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Nisn;
use App\Models\User;
use App\Models\Hobby;
use App\Models\Person;
use App\Models\Telephone;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $person = Person::create([
            'name' => 'John Doe',
        ]);

        Nisn::create([
            'nisn' => '1234567890',
            'person_id' => $person->id,
        ]);

        $hobby1 = Hobby::create(['name' => 'Bermain Bola']);
        $hobby2 = Hobby::create(['name' => 'Membaca Buku']);
        
        $person->hobbies()->attach([$hobby1->id, $hobby2->id]);

        Telephone::create([
            'telephone_number' => '08123456789',
            'person_id' => $person->id,
        ]);

        Blog::create([
            'user_id' => $user->id,
            'title' => 'First Blog Post',
            'slug' => 'first-blog-post',
            'content' => 'This is the content of the first blog post.',
            'featured_image' => 'featured_image.jpg',
            'slider_image' => 'slider_image.jpg',
        ]);
    }
}

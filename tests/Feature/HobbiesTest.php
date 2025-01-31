<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Hobby;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class HobbiesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    
    #[Test]
    public function it_can_display_the_hobbies_index_page()
    {
        $user = User::first();
        $this->actingAs($user);

        Hobby::create(['name' => 'Reading']);
        Hobby::create(['name' => 'Swimming']);
        Hobby::create(['name' => 'Cycling']);

        $response = $this->get(route('hobbies.index'));

        $response->assertStatus(200);
        $response->assertViewIs('hobbies.index');
        $response->assertViewHas('hobbies');
    }

    #[Test]
    public function it_can_display_the_create_hobby_page()
    {
        $user = User::first();
        $this->actingAs($user);

        $response = $this->get(route('hobbies.create'));

        $response->assertStatus(200);
        $response->assertViewIs('hobbies.create');
    }

    #[Test]
    public function it_can_store_a_new_hobby()
    {
        $user = User::first();
        $this->actingAs($user);

        $data = ['name' => 'Reading'];

        $response = $this->post(route('hobbies.store'), $data);

        $this->assertDatabaseHas('hobbies', $data);
        $response->assertRedirect(route('hobbies.index'));
        $response->assertSessionHas('success', 'Hobby created successfully.');
    }

    #[Test]
    public function it_can_display_the_edit_hobby_page()
    {
        $user = User::first();
        $this->actingAs($user);

        $hobby = Hobby::create(['name' => 'Reading']);

        $response = $this->get(route('hobbies.edit', $hobby));

        $response->assertStatus(200);
        $response->assertViewIs('hobbies.edit');
        $response->assertViewHas('hobby', $hobby);
    }

    #[Test]
    public function it_can_update_a_hobby()
    {
        $user = User::first();
        $this->actingAs($user);

        $hobby = Hobby::create(['name' => 'Reading']);
        $data = ['name' => 'Updated Hobby'];

        $response = $this->put(route('hobbies.update', $hobby), $data);

        $this->assertDatabaseHas('hobbies', $data);
        $response->assertRedirect(route('hobbies.index'));
        $response->assertSessionHas('success', 'Hobby updated successfully.');
    }

    #[Test]
    public function it_can_delete_a_hobby()
    {
        $user = User::first();
        $this->actingAs($user);

        $hobby = Hobby::create(['name' => 'Reading']);

        $response = $this->delete(route('hobbies.destroy', $hobby));

        $this->assertDatabaseMissing('hobbies', ['id' => $hobby->id]);
        $response->assertRedirect(route('hobbies.index'));
        $response->assertSessionHas('success', 'Hobby deleted successfully.');
    }
}

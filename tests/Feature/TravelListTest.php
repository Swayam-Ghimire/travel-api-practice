<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Travel;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class TravelListTest extends TestCase
{
    use RefreshDatabase;

    public function test_travels_list_returns_paginated_data_correctly(): void
    {
        Travel::factory()->count(16)->create(['is_public' => true]);
        $response = $this->get('/api/v1/travels');

        $response->assertStatus(200);
        $response->assertJsonCount(15, 'data');
        $response->assertJsonPath('meta.last_page', 2);
    }
    public function test_travels_list_shows_only_public_record(): void {
        $publicTravel = Travel::factory()->create(['is_public' => true]);
        Travel::factory()->create(['is_public' => false]);
        $response = $this->get('/api/v1/travels');
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonPath('data.0.name', $publicTravel->name);
    }
public function test_non_admin_users_cannot_add_travels(): void {
    $this->seed(RoleSeeder::class);

    $user = User::factory()->create();
    $user->roles()->attach(Role::where('name', 'editor')->value('id'));

    $payload = [
        'is_public' => true,
        'name' => 'Test Travel',
        'description' => 'A test travel package',
        'number_of_days' => 5,
    ];

    $response = $this->actingAs($user)->postJson('/api/v1/admin/travels', $payload);

    $response->assertStatus(403); // now should pass
}

}

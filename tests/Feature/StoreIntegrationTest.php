<?php

namespace Tests\Feature;

use App\Models\Marketplace;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreIntegrationTest extends TestCase
{
    public function test_user_can_store_integration(): void
    {
        $user = User::factory()->create();
        $data = [
            'marketplace' => Marketplace::factory()->create()->name,
            'username' => fake()->userName,
            'password' => fake()->password,
        ];

        $this->actingAs($user, 'api')
            ->json('POST', route('integration.store'), $data)
            ->assertStatus(201)
            ->assertJsonStructure(['id', 'username', 'marketplace', 'user']);
    }

    public function test_store_integration_with_username_failure(): void
    {
        $user = User::factory()->create();
        $data = [
            'marketplace' => Marketplace::factory()->create()->name,
            'password' => fake()->password,
        ];

        $this->actingAs($user, 'api')
            ->json('POST', route('integration.store'), $data)
            ->assertStatus(422)
            ->assertInvalid(['username']);
    }
}

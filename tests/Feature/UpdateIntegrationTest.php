<?php

namespace Tests\Feature;

use App\Models\Integration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateIntegrationTest extends TestCase
{
    public function test_user_can_update_integration(): void
    {
        $user = User::factory()->create();
        $integration = Integration::factory()->create([
            'user_id' => $user->id,
        ]);

        $data = [
            'username' => fake()->userName,
            'password' => fake()->password,
        ];

        $this->actingAs($user, 'api')
            ->json('PATCH', route('integration.update', ['integration' => $integration->id]), $data)
            ->assertStatus(200)
            ->assertJsonStructure(['id', 'username', 'marketplace', 'user']);
    }
}

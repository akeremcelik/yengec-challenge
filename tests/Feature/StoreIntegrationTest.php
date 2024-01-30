<?php

namespace Tests\Feature;

use App\Enums\MarketplaceType;
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
            'marketplace' => fake()->randomElement(MarketplaceType::cases())->value,
            'username' => fake()->userName,
            'password' => fake()->password,
        ];

        $this->actingAs($user, 'api')
            ->json('POST', route('integration.store'), $data)
            ->assertStatus(201)
            ->assertJsonStructure(['marketplace_id', 'user_id', 'username', 'password']);
    }
}

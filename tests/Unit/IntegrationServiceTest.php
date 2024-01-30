<?php

namespace Tests\Unit;

use App\Enums\MarketplaceType;
use App\Models\User;
use Tests\TestCase;

class IntegrationServiceTest extends TestCase
{
    public function test_create_integration_method(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'marketplace' => fake()->randomElement(MarketplaceType::cases())->value,
            'username' => fake()->userName,
            'password' => fake()->password,
        ];

        $integrationService = app('IntegrationService');
        $integration = $integrationService->createIntegration($data);

        $this->assertModelExists($integration);
    }
}

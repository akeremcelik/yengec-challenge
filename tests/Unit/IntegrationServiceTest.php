<?php

namespace Tests\Unit;

use App\Enums\MarketplaceType;
use App\Models\Integration;
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

    public function test_update_integration_method(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $integration = Integration::factory()->create();

        $data = [
            'username' => fake()->userName,
            'password' => fake()->password,
        ];

        $integrationService = app('IntegrationService');
        $integration = $integrationService->updateIntegration($integration, $data);

        foreach ($data as $key => $value)
        {
            $this->assertEquals($value, $integration->$key);
        }
    }

    public function test_delete_integration_method(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $integration = Integration::factory()->create();

        $integrationService = app('IntegrationService');
        $result = $integrationService->deleteIntegration($integration);

        $this->assertTrue($result);
        $this->assertModelMissing($integration);
    }
}

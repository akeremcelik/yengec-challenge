<?php

namespace Tests\Unit;

use App\Models\Integration;
use App\Models\Marketplace;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class IntegrationServiceTest extends TestCase
{
    public function test_create_integration_method(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'marketplace_id' => Marketplace::factory()->create()->id,
            'reference' => fake()->word,
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

        $this->assertEquals($data['username'], $integration->username);
        $this->assertTrue(Hash::check($data['password'], $integration->password));
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

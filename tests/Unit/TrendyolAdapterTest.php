<?php

namespace Tests\Unit;

use App\Models\Integration;
use Tests\TestCase;

class TrendyolAdapterTest extends TestCase
{
    public function test_create_integration(): void
    {
        $data = [
            'username' => fake()->userName,
            'password' => fake()->password,
        ];

        $trendyolAdapter = app('TrendyolAdapter');
        $response = $trendyolAdapter->createIntegration($data);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('status', $response);

        $response['status'] ?
            $this->assertArrayHasKey('reference', $response) :
            $this->assertArrayHasKey('message', $response);
    }

    public function test_update_integration(): void
    {
        $integration = Integration::factory()->create();

        $data = [
            'username' => fake()->userName,
            'password' => fake()->password,
        ];

        $trendyolAdapter = app('TrendyolAdapter');
        $response = $trendyolAdapter->updateIntegration($integration->reference, $data);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('status', $response);

        if (!$response['status'])
            $this->assertArrayHasKey('message', $response);
    }

    public function test_delete_integration(): void
    {
        $integration = Integration::factory()->create();

        $trendyolAdapter = app('TrendyolAdapter');
        $response = $trendyolAdapter->deleteIntegration($integration->reference);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('status', $response);

        if (!$response['status'])
            $this->assertArrayHasKey('message', $response);
    }
}

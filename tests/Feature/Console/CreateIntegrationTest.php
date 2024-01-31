<?php

namespace Tests\Feature\Console;

use App\Models\Integration;
use App\Models\Marketplace;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateIntegrationTest extends TestCase
{
    public function test_create_integration_via_console_command(): void
    {
        $marketplace = Marketplace::factory()->create();
        $username = fake()->userName;
        $password = fake()->word;

        $this->artisan("app:create-integration-command $marketplace->name $username $password");
        $integration = Integration::query()->first();

        $this->assertModelExists($integration);
        $this->assertEquals($marketplace->id, $integration->marketplace_id);
        $this->assertTrue(is_string($integration->reference));
        $this->assertTrue(is_null($integration->user_id));
        $this->assertEquals($username, $integration->username);
        $this->assertTrue(Hash::check($password, $integration->password));
    }
}

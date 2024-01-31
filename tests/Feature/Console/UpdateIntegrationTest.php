<?php

namespace Tests\Feature\Console;

use App\Models\Integration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UpdateIntegrationTest extends TestCase
{
    public function test_update_integration_via_console_command(): void
    {
        $integration = Integration::factory()->create();

        $username = fake()->userName;
        $password = fake()->word;

        $this->artisan("app:update-integration-command $integration->id --username=$username --password=$password");
        $integration = Integration::query()->first();

        $this->assertEquals($username, $integration->username);
        $this->assertTrue(Hash::check($password, $integration->password));
    }
}

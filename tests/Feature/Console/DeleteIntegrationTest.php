<?php

namespace Tests\Feature\Console;

use App\Models\Integration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteIntegrationTest extends TestCase
{
    public function test_delete_integration_via_console_command(): void
    {
        $integration = Integration::factory()->create();
        $this->artisan("app:delete-integration-command $integration->id");

        $this->assertModelMissing($integration);
    }
}

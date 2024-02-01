<?php

namespace Tests\Feature;

use App\Models\Integration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyIntegrationTest extends TestCase
{
    public function test_user_can_destroy_integration(): void
    {
        $user = User::factory()->create();
        $integration = Integration::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user, 'api')
            ->json('DELETE', route('integration.destroy', ['integration' => $integration->id]))
            ->assertNoContent();
    }
}

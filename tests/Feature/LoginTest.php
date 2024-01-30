<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_user_can_login(): void
    {
        $password = 123;
        $user = User::factory()->create([
            'password' => $password,
        ]);

        $data = [
            'email' => $user->email,
            'password' => $password,
        ];

        $this->json('POST', route('login'), $data)
            ->assertStatus(200)
            ->assertJsonStructure(['token']);
    }
}

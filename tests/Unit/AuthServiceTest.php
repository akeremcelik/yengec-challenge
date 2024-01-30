<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    public function test_register_method(): void
    {
        $data = [
            'name' => fake()->name,
            'email' => fake()->email,
            'password' => fake()->password,
        ];

        $authService = app('AuthService');
        $user = $authService->register($data);

        $this->assertModelExists($user);
    }

    public function test_login_method(): void
    {
        $password = 123;
        $user = User::factory()->create([
            'password' => $password,
        ]);

        $authService = app('AuthService');
        $token = $authService->login($user->email, $password);

        $this->assertTrue(is_string($token));
    }
}

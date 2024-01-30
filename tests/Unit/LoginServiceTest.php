<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class LoginServiceTest extends TestCase
{
    public function test_login_method(): void
    {
        $password = 123;
        $user = User::factory()->create([
            'password' => $password,
        ]);

        $loginService = app('LoginService');
        $token = $loginService->login($user->email, $password);

        $this->assertTrue(is_string($token));
    }
}

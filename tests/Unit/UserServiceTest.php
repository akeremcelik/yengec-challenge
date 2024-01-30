<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user_method()
    {
        $data = [
            'name' => fake()->name,
            'email' => fake()->email,
            'password' => fake()->password
        ];

        $userService = app('UserService');
        $user = $userService->createUser($data);

        $this->assertModelExists($user);
    }
}

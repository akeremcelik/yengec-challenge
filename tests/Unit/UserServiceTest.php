<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    public mixed $userService;

    public function setUp(): void
    {
        parent::setUp();
        $this->userService = app('UserService');
    }

    public function test_create_user()
    {
        $data = [
            'name' => fake()->name,
            'email' => fake()->email,
            'password' => fake()->password
        ];

        $user = $this->userService->createUser($data);
        $this->assertModelExists($user);
    }
}

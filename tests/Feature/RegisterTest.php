<?php

namespace Tests\Feature;

use App\Http\Resources\Api\V1\UserResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_register(): void
    {
        $data = [
            'name' => fake()->name,
            'email' => fake()->email,
            'password' => fake()->password
        ];

        $this->json('POST', route('register'), $data)
            ->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'email',
            ]);
    }

    public function test_register_with_email_failure(): void
    {
        $data = [
            'name' => fake()->name,
            'email' => 'email_failure',
            'password' => fake()->password
        ];

        $this->json('POST', route('register'), $data)
            ->assertStatus(422)
            ->assertInvalid(['email']);
    }
}

<?php

namespace Database\Factories;

use App\Models\Marketplace;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Integration>
 */
class IntegrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'marketplace_id' => Marketplace::factory()->create()->id,
            'reference' => fake()->word,
            'user_id' => User::factory()->create()->id,
            'username' => fake()->userName,
            'password' => fake()->password,
        ];
    }
}

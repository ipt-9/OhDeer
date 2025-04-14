<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->realTextBetween(5, 160),
            'description' => $this->faker->realTextBetween(5, 300),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'is_repair' => $this->faker->boolean(),
            'is_complete' => false,
            'category_id' => $this->faker->numberBetween(1, 4),
            'user_id' => 1,
        ];}
}


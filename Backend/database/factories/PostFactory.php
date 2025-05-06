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
            'title' => $this->faker->realTextBetween(5, 128),
            'description' => $this->faker->realTextBetween(5, 300),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'is_repair' => $this->faker->boolean(),
            'is_complete' => false,
            'image_1' => asset('OhDeerPlaceholder.png'),
            'image_2' => asset('OhDeerPlaceholder.png'),
            'image_3' => asset('OhDeerPlaceholder.png'),
            'image_4' => asset('OhDeerPlaceholder.png'),
            'image_5' => asset('OhDeerPlaceholder.png'),
            'category_id' => $this->faker->numberBetween(1, 4),
            'user_id' => 1,
        ];}
}


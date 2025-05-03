<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= bcrypt('password'),
            'iban' => fake()->randomNumber(),
            'address' => fake()->address(),
            'user_type_id' => 1,
            'language_id' => 1,
            'subscription_id' => 1,
            'postal_code' => fake()->randomNumber(),
            'phone_number' => fake()->phoneNumber(),
            'repair_rating' => fake()->numberBetween(1, 5),
            'general_rating' => fake()->numberBetween(1, 5),
            'website' => fake()->url(),
            'profile_image' => 'http://localhost:8000/OhDeerPlaceholder.png'//url('OhDeerPlaceholder.png')
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

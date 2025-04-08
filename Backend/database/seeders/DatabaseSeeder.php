<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Subscription;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        UserType::factory()->create(
            ['user_type_name' => 'Private']
        );
        UserType::factory()->create(
            ['user_type_name' => 'Business']
        );
        Language::factory()->create(
            ['language_name' => 'English']
        );
        Subscription::factory()->create(
            ['subscription_name' => 'Regular']
        );

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'user_type_id' => 1,
            'language_id' => 1,
            'subscription_id' => 1,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Fee;
use App\Models\Language;
use App\Models\Post;
use App\Models\Purchase;
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

        Category::factory()->create(
            ['category_name' => 'Electronics']
        );
        Category::factory()->create(
            ['category_name' => 'Furniture']
        );
        Category::factory()->create(
            ['category_name' => 'Clothing']
        );
        Category::factory()->create(
            ['category_name' => 'Housework']
        );

        Fee::factory()->create([
            'is_paid' => false,
            'due_date' => now(),
            'amount' => 12
        ]);

        User::factory()
            ->has(Post::factory()->count(5))
            ->count(2)
            ->create();

        Purchase::factory()->create([
            'amount' => 1,
            'timestamp' => now(),
            'date' => now(),
            'is_outstanding'=> false,
            'repair_rating'=> 2,
            'general_rating'=> 3,
            'rating_comment'=> 'Test User',
            'post_id'=> 1,
            'user_id'=> 1,
            'fee_id'=> 1
        ]);
    }
}

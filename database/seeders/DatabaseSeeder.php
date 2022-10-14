<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            FakeCategoriesSeeder::class,
            FakeProductsSeeder::class,
            FakeProductCategorySeeder::class,
            FakeProductImageSeeder::class,
            FakeUsersSeeder::class,
            FakeCartSeeder::class,
            FakeOrderSeeder::class,
            FakeOrderItemSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

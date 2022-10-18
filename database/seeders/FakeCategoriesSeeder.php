<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FakeCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::factory(20)->create();
    }
}

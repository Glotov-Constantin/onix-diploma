<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FakeProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProductCategory::factory(400)->create();
    }
}

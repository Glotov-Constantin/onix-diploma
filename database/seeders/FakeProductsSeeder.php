<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FakeProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Product::factory(400)->create();
    }
}

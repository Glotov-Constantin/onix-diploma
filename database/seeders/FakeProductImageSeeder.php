<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FakeProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProductImage::factory(100)->create();
    }
}

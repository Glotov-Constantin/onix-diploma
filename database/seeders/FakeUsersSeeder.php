<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class FakeUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(100)->create();
    }
}

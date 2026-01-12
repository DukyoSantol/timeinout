<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Call other seeders here, e.g.
        // $this->call(UserSeeder::class);

        $this->call([
        UsersTableSeeder::class,
    ]);
    }
}

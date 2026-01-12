<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create an admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'position' => 'Administrator',
            'division' => 'IT',
            'is_admin' => 1,
        ]);

        // Optionally, create a normal user
        User::create([
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'position' => 'Staff',
            'division' => 'HR',
            'is_admin' => 0,
        ]);
    }
}

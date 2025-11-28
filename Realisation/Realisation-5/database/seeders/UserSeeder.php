<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Regular Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        // Optional: Add a regular user for variety, though not necessary for your setup
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'role' => 'user',
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin already exists
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('adminadmin'), // default password
                'role' => 'admin',
            ]);
        }

        // Default User
        if (!User::where('email', 'user@gmail.com')->exists()) {
            User::create([
                'name' => 'Default User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('useruser'), // default password
                'role' => 'user',
            ]);
        }
    }
}
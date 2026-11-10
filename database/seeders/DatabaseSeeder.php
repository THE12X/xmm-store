<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@xmm.com'], // Checks if this email exists
            [
                'name'     => 'Admin User',
                'password' => Hash::make('9129'), // Set your admin password
                'role'     => 1, // Admin role
            ]
        );
    }
}
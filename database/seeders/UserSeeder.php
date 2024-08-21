<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Petugas',
            'email' => 'petugas@example.com',
            'password' => 'password',
            'role' => 'petugas'
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => 'password',
            'role' => 'user'
        ]);
    }
}

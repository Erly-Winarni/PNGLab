<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder2 extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Baru',
            'email' => 'admin1@pnglab.com',
            'password' => Hash::make('Password1.'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Teacher 4',
            'email' => 'teacher4@pnglab.com',
            'password' => Hash::make('Password1.'),
            'role' => 'teacher',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Erly Coy',
            'email' => 'student5@pnglab.com',
            'password' => Hash::make('Password1.'),
            'role' => 'student',
            'is_active' => true,
        ]);
    }
}

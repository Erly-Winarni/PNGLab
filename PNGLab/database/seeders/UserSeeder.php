<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@pnglab.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Teacher One',
            'email' => 'teacher1@pnglab.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Teacher Two',
            'email' => 'teacher2@pnglab.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Student One',
            'email' => 'student1@pnglab.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Student Two',
            'email' => 'student2@pnglab.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'is_active' => true,
        ]);
    }
}

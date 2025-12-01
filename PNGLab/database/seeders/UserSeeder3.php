<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder3 extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Baru Sekali',
            'email' => 'erlyerly440@gmail.com',
            'password' => Hash::make('Password1.'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Teacher empat',
            'email' => 'erlyerly871@gmail.com',
            'password' => Hash::make('Password1.'),
            'role' => 'teacher',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Erly Coy',
            'email' => 'aoaoiaoi72@gmail.com',
            'password' => Hash::make('Password1.'),
            'role' => 'student',
            'is_active' => true,
        ]);
    }
}

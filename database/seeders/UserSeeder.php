<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun ADMIN
        User::updateOrCreate(
            ['email' => 'admin@polines.ac.id'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );
        // 2. Akun MAHASISWA (Hanya untuk Login, data profil ada di tabel lain)
    }
}

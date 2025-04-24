<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::firstOrCreate(
            ['email' => 'admin@creche.com'],
            [
                'name' => 'Administrador',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );

        // Educadora
        User::firstOrCreate(
            ['email' => 'educador@creche.com'],
            [
                'name' => 'Educadora luisa',
                'role' => 'educador',
                'password' => Hash::make('educadora123'),
            ]
        );

        // Pai/Mãe
        User::firstOrCreate(
            ['email' => 'pai@creche.com'],
            [
                'name' => 'Ana',
                'role' => 'pai',
                'password' => Hash::make('pai123'),
            ]
        );
    }
}

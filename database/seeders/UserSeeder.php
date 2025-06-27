<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create(
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'is_admin' => 1,
            ]
        );

        User::Create(
            [
                'name' => 'yas',
                'email' => 'yas@gmail.com',
                'password' => Hash::make('yas123'),
                'is_admin' => 0,
            ]
        );

    }
}

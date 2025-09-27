<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 3 Admin
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'username' => "admin$i",
                'role' => 'admin',
                'password' => Hash::make('password123'), // default password
            ]);
        }

        // 3 Guru
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'username' => "guru$i",
                'role' => 'guru',
                'password' => Hash::make('password123'),
            ]);
        }

        // 3 Siswa
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'username' => "siswa$i",
                'role' => 'siswa',
                'password' => Hash::make('password123'),
            ]);
        }
    }
}

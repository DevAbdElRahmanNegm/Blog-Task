<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Author User $i",
                'email' => "author$i@example.com",
                'password' => Hash::make('password'),
                'role' => 'author',
            ]);
        }
    }
}

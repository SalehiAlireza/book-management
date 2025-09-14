<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'phone' => '09120000000',
            'membership_date' => now(),
            'password' => bcrypt('admin123'),
        ]);

        User::create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'phone' => '09121111111',
            'membership_date' => now(),
            'password' => bcrypt('user123'),
        ]);

        User::factory(10)->create();
    }
}

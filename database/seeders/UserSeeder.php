<?php

namespace Database\Seeders;

use App\Models\User;
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
            'nama' => 'Admin Konveksi',
            'username' => 'admin123',
            'password' => bcrypt('123'),
        ]);

        User::create([
            'nama' => 'Author',
            'username' => 'kuliit',
            'password' => bcrypt('kuliit'),
        ]);
    }
}

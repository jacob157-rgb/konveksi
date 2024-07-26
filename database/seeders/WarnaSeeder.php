<?php

namespace Database\Seeders;

use App\Models\Warna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarnaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Warna::create([
            'nama' => 'Putih',
        ]);
        Warna::create([
            'nama' => 'Hitam',
        ]);
        Warna::create([
            'nama' => 'Merah',
        ]);
        Warna::create([
            'nama' => 'Biru',
        ]);
        Warna::create([
            'nama' => 'Abu Abu',
        ]);
    }
}

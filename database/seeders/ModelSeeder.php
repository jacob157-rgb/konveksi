<?php

namespace Database\Seeders;

use App\Models\Models;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Models::create([
            'nama' => 'Kemeja',
        ]);
        Models::create([
            'nama' => 'Baby Knit',
        ]);
        Models::create([
            'nama' => 'T-Shirt',
        ]);
        Models::create([
            'nama' => 'Blouse',
        ]);
        Models::create([
            'nama' => 'Hoodie',
        ]);
    }
}

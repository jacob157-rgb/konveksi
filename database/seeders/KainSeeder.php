<?php

namespace Database\Seeders;

use App\Models\Kain;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kain::create([
            'nama' => 'Katun',
        ]);
        Kain::create([
            'nama' => 'Sutra',
        ]);
        Kain::create([
            'nama' => 'Wol',
        ]);
        Kain::create([
            'nama' => 'Linen',
        ]);
        Kain::create([
            'nama' => 'Poliester',
        ]);
    }
}

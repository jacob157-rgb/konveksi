<?php

namespace Database\Seeders;

use App\Models\Supplyer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplyer::create([
            'nama' => 'Ucup',
        ]);
        Supplyer::create([
            'nama' => 'Sinta',
        ]);
        Supplyer::create([
            'nama' => 'Abdullah',
        ]);
    }
}

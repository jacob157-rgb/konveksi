<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Karyawan::create([
            'jenis_karyawan' => 'cutting',
            'nama' => 'Gondrong',
            'no' => '123443211432',
            'alamat' => 'Tembok',
        ]);
        Karyawan::create([
            'jenis_karyawan' => 'cutting',
            'nama' => 'Sani',
            'no' => '123443211432',
            'alamat' => 'Tembok',
        ]);
        Karyawan::create([
            'jenis_karyawan' => 'jahit',
            'nama' => 'Wawan',
            'no' => '123443211432',
            'alamat' => 'Tembok',
        ]);
        Karyawan::create([
            'jenis_karyawan' => 'jahit',
            'nama' => 'Irham',
            'no' => '123443211432',
            'alamat' => 'Tembok',
        ]);
        Karyawan::create([
            'jenis_karyawan' => 'jahit',
            'nama' => 'Adelia',
            'no' => '123443211432',
            'alamat' => 'Tembok',
        ]);
    }
}

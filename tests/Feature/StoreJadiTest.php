<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\BarangJadi;
use App\Models\Supplyer;

class StoreJadiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_barang_jadi()
    {
        // Buat data dummy untuk supplyer
        $supplyer = Supplyer::factory()->create();

        // Buat data dummy untuk request
        $data = [
            'tanggal_kirim' => '2024-07-28',
            'supplyer_id' => $supplyer->id,
            'model' => 'Model Example',
            'warna' => 'Merah',
            'jumlah' => 10,
            'harga' => 5000,
            'total' => 50000,
        ];

        // Simulasikan permintaan POST ke route yang memanggil metode storeJadi
        $response = $this->post('/jadi', $data);

        // Periksa apakah data telah disimpan dalam database
        $this->assertDatabaseHas('barang_jadis', [
            'supplyer_id' => $supplyer->id,
            'tanggal_kirim' => '2024-07-28',
        ]);

        // Periksa apakah respon redirect ke /supplyer dengan pesan sukses
        $response->assertRedirect('/supplyer');
        $response->assertSessionHas('success', 'Barang Jadi Berhasil Ditambahkan.');
    }
}

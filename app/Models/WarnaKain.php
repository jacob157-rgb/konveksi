<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarnaKain extends Model
{
    use HasFactory;
    protected $table = 'warna_kain';
    protected $guarded = ['id'];

    public function kain_barang_mentah() {
        return $this->belongsTo(KainBarangMentah::class);
    }
    static function getByWarnaKain($warnaKain) {
        return static::where('kain_mentah_id', $warnaKain)->get();
    }
}

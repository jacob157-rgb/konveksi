<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBarangJadi extends Model
{
    use HasFactory;
    protected $table = 'model_barang_jadi';
    protected $guarded = ['id'];

    public function barang_jadi() {
        return $this->belongsTo(BarangJadi::class);
    }

    static function getByBarangJadi($barangJadiId) {
        return static::where('barang_jadi_id', $barangJadiId)->get();
    }
}

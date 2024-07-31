<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KainBarangMentah extends Model
{
    use HasFactory;
    protected $table = 'kain_barang_mentah';
    protected $guarded = ['id'];

    public function barang_jadi()
    {
        return $this->belongsTo(BarangJadi::class);
    }

    static function getByBarangMentah($barangMentahId)
    {
        return static::where('barang_mentah_id', $barangMentahId)->get();
    }
}

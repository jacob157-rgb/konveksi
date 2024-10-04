<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangJadi extends Model
{
    use HasFactory;
    protected $table = 'barang_jadi';
    protected $guarded = ['id'];

    public function modelBarangJadi()
    {
        return $this->hasMany(ModelBarangJadi::class);
    }

    public function supplyer()
    {
        return $this->belongsTo(Supplyer::class);
    }
    public function warna()
    {
        return $this->belongsTo(Warna::class);
    }
    public function kain()
    {
        return $this->belongsTo(Kain::class);
    }
    public function model()
    {
        return $this->belongsTo(Models::class);
    }


    static function getUniqueId($unique)
    {
        return static::where('unique_id', $unique)->get();
    }
    static function getUniqueBarangDatang($unique)
    {

        return static::with(['modelBarangJadi.warnaModel'])
            ->where('unique_id', $unique)
            ->latest()
            ->get();;
    }
}

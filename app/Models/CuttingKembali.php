<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuttingKembali extends Model
{
    use HasFactory;
    protected $table = 'cutting_kembali';
    protected $guarded = ['id'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    static function getCuttingWarnaModel($id_cutting_warna_model)
    {
        return static::where('id_cutting_warna_model', $id_cutting_warna_model)->first();
    }

    static function isitReturn($id_cutting_warna_model)
    {
        $result = static::where('id_cutting_warna_model', $id_cutting_warna_model)
            ->first();
        // dd($result);
        return $result;
    }

    public function gaji()
    {
        return $this->belongsTo(Gaji::class);
    }
}

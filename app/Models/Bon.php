<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bon extends Model
{
    use HasFactory;
    protected $table = 'bon';
    protected $guarded = ['id'];

    public function karyawan(){
        return $this->belongsTo(Karyawan::class);
    }

    static function getCutting($karyawan, $cutting) {
        return static::where('karyawan_id', $karyawan)->where('cutting_id', $cutting)->first();
    }
    static function getJahit($karyawan, $jahit) {
        return static::where('karyawan_id', $karyawan)->where('jahit_id', $jahit)->first();
    }

    static function getBonCutting($karyawan, $cutting) {
        $data = [
            'sum' => Bon::where('cutting_ambil', $cutting)->where('id_karyawan', $karyawan)->sum('nominal'),
            'listData' => Bon::where('cutting_ambil', $cutting)->where('id_karyawan', $karyawan)->get(),
        ];
        return $data;
    }
}

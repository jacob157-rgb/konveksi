<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $table = 'gaji';
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

    static function getGajiCutting($karyawan, $cutting) {
        $data = [
            'paid' => Gaji::where('cutting_ambil', $cutting)->where('id_karyawan', $karyawan)->sum('nominal_terbayarkan'),
            'unpaid' => Gaji::where('cutting_ambil', $cutting)->where('id_karyawan', $karyawan)->sum('nominal'),
            'listData' => Gaji::where('cutting_ambil', $cutting)->where('id_karyawan', $karyawan)->get(),
        ];
        return $data;
    }

    static function getGajiByWarna($cutting) {

        return static::where('cutting_kembali', $cutting)->first();
    }
}

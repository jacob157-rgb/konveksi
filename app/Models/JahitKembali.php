<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JahitKembali extends Model
{
    use HasFactory;
    protected $table = 'jahit_kembali';
    protected $guarded = ['id'];

    public function karyawan(){
        return $this->belongsTo(Karyawan::class);
    }

    static function getJahitWarnaModel($id_jahit_warna_model) {
        return static::where('id_jahit_warna_model', $id_jahit_warna_model)->first();
    }

    public function gaji() {
        return $this->belongsTo(Gaji::class);
    }
}

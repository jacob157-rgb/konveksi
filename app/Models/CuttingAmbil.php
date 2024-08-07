<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuttingAmbil extends Model
{
    use HasFactory;
    protected $table = 'cutting_ambil';
    protected $guarded = ['id'];

    public function karyawan(){
        return $this->belongsTo(Karyawan::class);
    }
    public function bon() {
        return $this->belongsTo(Bon::class);
    }
    public function gaji() {
        return $this->belongsTo(Gaji::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuttingKembali extends Model
{
    use HasFactory;
    protected $table = 'cutting_kembali';
    protected $guarded = ['id'];

    public function karyawan(){
        return $this->belongsTo(Karyawan::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cutting extends Model
{
    use HasFactory;
    protected $table = 'cutting';
    protected $guarded = ['id'];

    public function barang(){
        return $this->belongsTo(Barang::class);
    }

    public function karyawan(){
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}

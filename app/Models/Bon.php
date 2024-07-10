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

    public function cutting() {
        return $this->belongsTo(Cutting::class);
    }

    public function jahit() {
        return $this->belongsTo(Jahit::class);
    }
}

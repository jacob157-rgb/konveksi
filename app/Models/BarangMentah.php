<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMentah extends Model
{
    use HasFactory;
    protected $table = 'barang_mentah';
    protected $guarded = ['id'];

    public function supplyer() {
        return $this->belongsTo(Supplyer::class);
    }
    public function kain() {
        return $this->belongsTo(Kain::class);
    }

    public function cutting() {
        return $this->hasMany(Cutting::class);
    }
    public function jahit() {
        return $this->hasMany(Jahit::class);
    }
}

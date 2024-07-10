<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $guarded = ['id'];

    public function supplyer() {
        return $this->belongsTo(Supplyer::class);
    }

    public function cutting() {
        return $this->hasMany(Cutting::class);
    }
    public function jahit() {
        return $this->hasMany(Jahit::class);
    }
}

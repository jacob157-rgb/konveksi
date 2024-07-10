<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kain extends Model
{
    use HasFactory;
    protected $table = 'kain';
    protected $guarded = ['id'];

    public function barang() {
        return $this->hasMany(Barang::class);
    }
}

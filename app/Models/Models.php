<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    use HasFactory;
    protected $table = 'model';
    protected $guarded = ['id'];

    public function barang() {
        return $this->hasMany(Barang::class);
    }
}

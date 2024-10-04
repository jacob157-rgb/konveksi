<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnBarang extends Model
{
    use HasFactory;
    protected $table = 'return_barang';
    protected $guarded = ['id'];


    static function getReturnByUniqueId($unique) {
        return static::where('unique_id', $unique)->get();
    }
}

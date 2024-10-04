<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selisih extends Model
{
    use HasFactory;
    protected $table = 'selisih';
    protected $guarded = ['id'];


    static function getSelisihByUniqueId($unique) {
        return static::where('unique_id', $unique)->get();
    }
}

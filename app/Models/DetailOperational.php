<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOperational extends Model
{
    use HasFactory;
    protected $table = 'detail_operational';
    protected $guarded = ['id'];

    public function operational(){
        return $this->belongsTo(Operational::class);
    }
}

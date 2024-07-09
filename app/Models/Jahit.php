<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jahit extends Model
{
    use HasFactory;
    protected $table = 'jahit';
    protected $guarded = ['id'];
}

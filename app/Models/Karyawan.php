<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawan';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function bon()
    {
        return $this->hasMany(Bon::class);
    }

    public function cutting()
    {
        return $this->hasMany(Cutting::class);
    }

    public function jahit()
    {
        return $this->hasMany(Jahit::class);
    }
}

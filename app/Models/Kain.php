<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kain extends Model
{
    use HasFactory;
    protected $table = 'kain';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function barangMentah() {
        return $this->hasMany(BarangMentah::class);
    }
}

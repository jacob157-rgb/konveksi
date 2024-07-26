<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    use HasFactory;
    protected $table = 'model';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function barangMentah() {
        return $this->hasMany(BarangMentah::class);
    }
    public function barangJadi() {
        return $this->hasMany(BarangJadi::class);
    }
}

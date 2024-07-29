<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarnaModel extends Model
{
    use HasFactory;
    protected $table = 'warna_model';
    protected $guarded = ['id'];

    public function model_barang_jadi() {
        return $this->belongsTo(ModelBarangJadi::class);
    }
    static function getByWarnaModel($warnaModel) {
        return static::where('model_barang_jadi_id', $warnaModel)->get();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuttingWarnaModel extends Model
{
    use HasFactory;
    protected $table = 'cutting_warna_model';
    protected $guarded = ['id'];

    public function cuttingAmbilModel() {
        return $this->belongsTo(CuttingAmbilModel::class);
    }

    static function ambilModel($ambilModelId) {
        return static::where('id_ambil_model', $ambilModelId)->get();
    }
}

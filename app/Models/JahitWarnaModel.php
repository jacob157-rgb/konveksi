<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JahitWarnaModel extends Model
{
    use HasFactory;
    protected $table = 'jahit_warna_model';
    protected $guarded = ['id'];

    public function jahitAmbilModel() {
        return $this->belongsTo(JahitAmbilModel::class);
    }

    static function ambilModel($ambilModelId) {
        return static::where('id_ambil_model', $ambilModelId)->get();
    }
}

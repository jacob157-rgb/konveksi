<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuttingAmbilModel extends Model
{
    use HasFactory;
    protected $table = 'cutting_ambil_model';
    protected $guarded = ['id'];

    public function cuttingAmbil() {
        return $this->belongsTo(CuttingAmbil::class);
    }
    public function cuttingKembali() {
        return $this->belongsTo(CuttingKembali::class);
    }

    static function getReturnNull($id_ambil) {
        return static::where('id_cutting_ambil', $id_ambil)->get();
    }
}

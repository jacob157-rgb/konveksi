<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JahitAmbilModel extends Model
{
    use HasFactory;
    protected $table = 'jahit_ambil_model';
    protected $guarded = ['id'];

    public function jahitAmbil() {
        return $this->belongsTo(JahitAmbil::class);
    }
    public function jahitKembali() {
        return $this->belongsTo(JahitKembali::class);
    }

    static function getReturnNull($id_ambil) {
        return static::where('id_jahit_ambil', $id_ambil)->get();
    }
}

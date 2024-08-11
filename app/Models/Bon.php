<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bon extends Model
{
    use HasFactory;
    protected $table = 'bon';
    protected $guarded = ['id'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    static function getCutting($karyawan, $cutting)
    {
        return static::where('karyawan_id', $karyawan)->where('cutting_id', $cutting)->first();
    }
    static function getJahit($karyawan, $jahit)
    {
        return static::where('karyawan_id', $karyawan)->where('jahit_id', $jahit)->first();
    }
    static function getAllCutting($karyawan)
    {
        $queryDate = request()->query('bonDays');
        $queryLunas = request()->query('bon');

        $bonQuery = static::where('id_karyawan', $karyawan)->latest();
        if ($queryDate) {
            $queryDate = \Carbon\Carbon::parse($queryDate)->format('Y-m-d');
            $bonQuery->whereDate('created_at', $queryDate);
        } 

        if ($queryLunas) {
            $bonQuery->where('status', 'lunas');
        } else {
            $bonQuery->whereIn('status', ['terbayarkan', 'belum terbayarkan']);
        }

        $data = [
            'listData' => $bonQuery->get(),
        ];

        return $data;
    }

    static function getBonCutting($karyawan, $cutting)
    {
        $data = [
            'sum' => Bon::where('cutting_ambil', $cutting)->where('id_karyawan', $karyawan)->sum('nominal'),
            'paid' => Bon::where('cutting_ambil', $cutting)->where('id_karyawan', $karyawan)->sum('nominal_terbayarkan'),
            'unpaid' => Bon::where('cutting_ambil', $cutting)->where('id_karyawan', $karyawan)->sum('nominal_belum_terbayarkan'),
            'listData' => Bon::where('cutting_ambil', $cutting)->where('id_karyawan', $karyawan)->get(),
        ];
        // dd($data['listData'][0]['nominal']);
        return $data;
    }
    static function getBonJahit($karyawan, $jahit)
    {
        $data = [
            'sum' => Bon::where('jahit_ambil', $jahit)->where('id_karyawan', $karyawan)->sum('nominal'),
            'paid' => Bon::where('jahit_ambil', $jahit)->where('id_karyawan', $karyawan)->sum('nominal_terbayarkan'),
            'unpaid' => Bon::where('jahit_ambil', $jahit)->where('id_karyawan', $karyawan)->sum('nominal_belum_terbayarkan'),
            'listData' => Bon::where('jahit_ambil', $jahit)->where('id_karyawan', $karyawan)->get(),
        ];
        // dd($data['listData'][0]['nominal']);
        return $data;
    }
}

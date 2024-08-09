<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $table = 'gaji';
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

    static function getGajiCutting($karyawan, $cutting)
    {
        $data = [
            'sum' => Gaji::where('cutting_ambil', $cutting)->where('id_karyawan', $karyawan)->sum('nominal'),
            'paid' => Gaji::where('cutting_ambil', $cutting)->where('id_karyawan', $karyawan)->sum('nominal_terbayarkan'),
            'unpaid' => Gaji::where('cutting_ambil', $cutting)->where('id_karyawan', $karyawan)->sum('nominal_belum_terbayarkan'),
            'listData' => Gaji::where('cutting_ambil', $cutting)->where('id_karyawan', $karyawan)->get(),
        ];
        return $data;
    }

    static function getGajiByWarna($cutting)
    {
        return static::where('cutting_kembali', $cutting)->first();
    }

    static function getGaji($karyawan)
    {
        $post = Gaji::where('id_karyawan', $karyawan)->latest();
        $days = request()?->query('days');
        $lunas = request()?->query('lunas');
        $startDate = \Carbon\Carbon::parse($days)->subDays(6);

        if ($days) {
            $sum = $post
                ->whereIn('status', ['terbayarkan', 'belum terbayarkan'])
                ->whereBetween('created_at', [$startDate, $days])
                ->count();
            $listData = $post
                ->whereIn('status', ['terbayarkan', 'belum terbayarkan'])
                ->whereBetween('created_at', [$startDate, $days])
                ->orderBy('id', 'desc')
                ->get();
        } elseif($lunas) {
            $sum = $post->count();
            $listData = $post
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $sum = $post->whereIn('status', ['terbayarkan', 'belum terbayarkan'])->count();
            $listData = $post
                ->whereIn('status', ['terbayarkan', 'belum terbayarkan'])
                ->orderBy('id', 'desc')
                ->get();
        }
        $data = [
            'sum' => $sum,
            'listData' => $listData,
        ];
        return $data;
    }
}

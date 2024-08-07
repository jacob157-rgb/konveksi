<?php

namespace App\Http\Controllers;

use App\Models\JahitAmbil;
use App\Models\JahitAmbilModel;
use App\Models\JahitKembali;
use App\Models\JahitWarnaModel;
use App\Models\KainBarangMentah;
use App\Models\Karyawan;
use App\Models\Models;
use App\Models\Warna;
use App\Models\WarnaKain;
use App\Models\Bon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class JahitController extends Controller
{
    public function getAmbilJahit($id)
    {
        $data = [
            'karyawan' => Karyawan::find($id),
            'model' => Models::all(),
            'warna' => Warna::all(),
        ];
        return view('pages.karyawan.jahit.ambil', $data);
    }
    public function getKembaliJahit(Request $request, $id)
    {
        $jahitAmbil = JahitAmbil::orderBy('id', 'desc')->where('id_karyawan', $id)->latest();
        if ($request->query('date')) {
            $tanggal = $request->query('date');
            $jahitAmbil->whereDate('tanggal_ambil', $tanggal);
        }
        $data = [
            'karyawan' => Karyawan::find($id),
            'jahitAmbil' => $jahitAmbil->get(),
        ];
        return view('pages.karyawan.jahit.kembali', $data);
    }

    public function postAmbilJahit(Request $request, $id)
    {
        // dd($request->all());
        $karyawan = Karyawan::find($id);
        $validator = Validator::make($request->all(), [
            'tanggal_ambil' => 'required',
            'karyawan_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        $jahit_ambil = JahitAmbil::create([
            'id_karyawan' => $karyawan->id,
            'tanggal_ambil' => $request->tanggal_ambil,
        ]);

        foreach ($request->model as $modelData) {
            $ambilModel = JahitAmbilModel::create([
                'id_jahit_ambil' => $jahit_ambil->id,
                'model' => $modelData['nama'],
            ]);

            foreach ($modelData['warna'] as $warnaData) {
                JahitWarnaModel::create([
                    'id_ambil_model' => $ambilModel->id,
                    'warna' => $warnaData['warna'],
                    'jumlah_ambil' => Str::of($warnaData['jumlah_ambil'])->remove('.'),
                    'satuan_ambil' => Str::of($warnaData['satuan_ambil'])->remove('.'),
                    'ongkos' => Str::of($warnaData['ongkos'])->remove('.'),
                ]);
            }
        }

        if ($request->nominal_bon) {
            Bon::create([
                'id_karyawan' => $karyawan->id,
                'jahit_ambil' => $jahit_ambil->id,
                'nominal' => Str::of($request->nominal_bon)->remove('.'),
            ]);
        }

        return response()->json(
            [
                'success' => true,
            ],
            201,
        );
    }

    public function postKembaliJahit(Request $request, $id_karyawan, $id_warna)
    {
        $warnaModelKembali = JahitWarnaModel::find($id_warna);

        if (!$warnaModelKembali) {
            return response()->json(['error' => 'Warna model tidak ditemukan'], 404);
        }

        $jahitKembali = JahitKembali::where('id_jahit_warna_model', $warnaModelKembali->id)->first();
        $kalkulasi = $request?->jumlah_kembali * $warnaModelKembali->ongkos;

        if ($jahitKembali) {
            $jahitKembali->update([
                'jumlah_kembali' => $request?->jumlah_kembali == null ? $jahitKembali->jumlah_kembali : $request->jumlah_kembali,
                'satuan_kembali' => 'pcs',
                'total_ongkos' => $request?->jumlah_kembali == null ? $jahitKembali->total_ongkos : $kalkulasi,
                'tanggal_kembali' => $request->tanggal_kembali ?? $jahitKembali->tanggal_kembali,
                'id_jahit_warna_model' => $warnaModelKembali->id,
            ]);
        } else {
            JahitKembali::create([
                'id_jahit_warna_model' => $warnaModelKembali->id,
                'jumlah_kembali' => $request->jumlah_kembali,
                'satuan_kembali' => 'pcs',
                'total_ongkos' => $kalkulasi,
                'tanggal_kembali' => $request->tanggal_kembali,
            ]);
        }

        return response()->json(
            [
                'success' => true,
                'warna' => JahitWarnaModel::find($id_warna),
                'karyawan' => $id_karyawan,
                'request' => $request->all(),
                'kalkulasi' => $request?->jumlah_kembali == null ? $jahitKembali->total_ongkos : $kalkulasi,
            ],
            201,
        );
    }
}

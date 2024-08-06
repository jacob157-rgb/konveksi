<?php

namespace App\Http\Controllers;

use App\Models\CuttingAmbil;
use App\Models\CuttingAmbilModel;
use App\Models\CuttingKembali;
use App\Models\CuttingWarnaModel;
use App\Models\KainBarangMentah;
use App\Models\Karyawan;
use App\Models\Models;
use App\Models\Warna;
use App\Models\WarnaKain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CuttingController extends Controller
{
    public function getAmbilCutting($id)
    {
        $data = [
            'karyawan' => Karyawan::find($id),
            'model' => Models::all(),
            'warna' => Warna::all(),
        ];
        return view('pages.karyawan.cutting.ambil', $data);
    }
    public function getKembaliCutting(Request $request, $id)
    {
        $cuttingAmbil = CuttingAmbil::orderBy('id', 'desc')->where('id_karyawan', $id)->latest();
        if ($request->query('date')) {
            $tanggal = $request->query('date');
            $cuttingAmbil->whereDate('tanggal_ambil', $tanggal);
        }

        $data = [
            'karyawan' => Karyawan::find($id),
            'cuttingAmbil' => $cuttingAmbil->get(),
        ];
        return view('pages.karyawan.cutting.kembali', $data);
    }

    public function postAmbilCutting(Request $request, $id)
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

        $cutting_ambil = CuttingAmbil::create([
            'id_karyawan' => $karyawan->id,
            'tanggal_ambil' => $request->tanggal_ambil,
        ]);

        foreach ($request->model as $modelData) {
            $ambilModel = CuttingAmbilModel::create([
                'id_cutting_ambil' => $cutting_ambil->id,
                'model' => $modelData['nama'],
            ]);

            foreach ($modelData['warna'] as $warnaData) {
                CuttingWarnaModel::create([
                    'id_ambil_model' => $ambilModel->id,
                    'warna' => $warnaData['warna'],
                    'jumlah_ambil' => Str::of($warnaData['jumlah_ambil'])->remove('.'),
                    'satuan_ambil' => Str::of($warnaData['satuan_ambil'])->remove('.'),
                    'ongkos' => Str::of($warnaData['ongkos'])->remove('.'),
                ]);
            }
        }

        return response()->json(
            [
                'success' => true,
            ],
            201,
        );
    }

    public function postKembaliCutting(Request $request, $id_karyawan, $id_warna)
    {
        $warnaModelKembali = CuttingWarnaModel::find($id_warna);

        if (!$warnaModelKembali) {
            return response()->json(['error' => 'Warna model tidak ditemukan'], 404);
        }

        $cuttingKembali = CuttingKembali::where('id_cutting_warna_model', $warnaModelKembali->id)->first();
        $kalkulasi = $request?->jumlah_kembali * $warnaModelKembali->ongkos;

        if ($cuttingKembali) {
            $cuttingKembali->update([
                'jumlah_kembali' => $request?->jumlah_kembali == null ? $cuttingKembali->jumlah_kembali : $request->jumlah_kembali,
                'satuan_kembali' => 'pcs',
                'total_ongkos' => $request?->jumlah_kembali == null ? $cuttingKembali->total_ongkos : $kalkulasi,
                'tanggal_kembali' => $request->tanggal_kembali ?? $cuttingKembali->tanggal_kembali,
                'id_cutting_warna_model' => $warnaModelKembali->id,
            ]);
        } else {
            CuttingKembali::create([
                'id_cutting_warna_model' => $warnaModelKembali->id,
                'jumlah_kembali' => $request->jumlah_kembali,
                'satuan_kembali' => 'pcs',
                'total_ongkos' => $kalkulasi,
                'tanggal_kembali' => $request->tanggal_kembali,
            ]);
        }

        return response()->json(
            [
                'success' => true,
                'warna' => CuttingWarnaModel::find($id_warna),
                'karyawan' => $id_karyawan,
                'request' => $request->all(),
                'kalkulasi' => $request?->jumlah_kembali == null ? $cuttingKembali->total_ongkos : $kalkulasi,
            ],
            201,
        );
    }
}

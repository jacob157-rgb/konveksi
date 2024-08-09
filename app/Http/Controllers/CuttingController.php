<?php

namespace App\Http\Controllers;

use App\Models\Bon;
use App\Models\Gaji;
use App\Models\Warna;
use App\Models\Models;
use App\Models\Karyawan;
use App\Models\WarnaKain;
use Illuminate\Support\Str;
use App\Models\CuttingAmbil;
use Illuminate\Http\Request;
use App\Models\CuttingKembali;
use App\Models\KainBarangMentah;
use App\Models\CuttingAmbilModel;
use App\Models\CuttingWarnaModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
                $cuttingWarnaModel = CuttingWarnaModel::create([
                    'id_ambil_model' => $ambilModel->id,
                    'warna' => $warnaData['warna'],
                    'jumlah_ambil' => Str::of($warnaData['jumlah_ambil'])->remove('.'),
                    'satuan_ambil' => Str::of($warnaData['satuan_ambil'])->remove('.'),
                    'ongkos' => Str::of($warnaData['ongkos'])->remove('.'),
                ]);
            }
        }

        if ($request->nominal_bon && $request->nominal_bon != 0) {
            Bon::create([
                'id_karyawan' => $karyawan->id,
                'cutting_ambil' => $cutting_ambil->id,
                'nominal' => Str::of($request->nominal_bon)->remove('.'),
                'nominal_belum_terbayarkan' => Str::of($request->nominal_bon)->remove('.'),
                'nominal_terbayarkan' => '0',
            ]);
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

        $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:cutting_warna_model,id',
            'jumlah_kembali' => 'required|integer',
            'satuan_kembali' => 'required|string',
            'tanggal_kembali' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kalkulasi = $request->jumlah_kembali * $warnaModelKembali->ongkos;

        $cuttingKembali = CuttingKembali::create([
            'id_cutting_warna_model' => $warnaModelKembali->id,
            'jumlah_kembali' => $request->jumlah_kembali,
            'satuan_kembali' => $request->satuan_kembali ?: 'pcs',
            'total_ongkos' => $kalkulasi,
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        $cuttingAmbilModel = CuttingAmbilModel::whereId($warnaModelKembali->id_ambil_model)->first();
        $cuttingAmbil = CuttingAmbil::whereId($cuttingAmbilModel->id_cutting_ambil)->first();

        $bonCuttingAmbil = Bon::where('cutting_ambil', $cuttingAmbil->id)
            ->whereIn('status', ['terbayarkan', 'belum terbayarkan'])
            ->first();

        if ($request->boolean('bbon')) {
            $validator = Validator::make($request->all(), [
                'nominal_bayar_bon' => 'required|decimal:3',
                'nominal_bayar' => 'required|decimal:3',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $nominalBayarBon = (int) Str::of($request->nominal_bayar_bon)->remove('.')->toString();
            if ($bonCuttingAmbil) {
                $hitungBon = $bonCuttingAmbil->nominal_belum_terbayarkan - $nominalBayarBon;
                if ($hitungBon == 0) {
                    $bonCuttingAmbil->update([
                        'nominal_belum_terbayarkan' => $hitungBon,
                        'nominal_terbayarkan' => $bonCuttingAmbil->nominal_terbayarkan + $nominalBayarBon,
                        'status' => 'lunas',
                    ]);
                } else if ($hitungBon > 0) {
                    $bonCuttingAmbil->update([
                        'nominal_belum_terbayarkan' => $bonCuttingAmbil->nominal_belum_terbayarkan - $nominalBayarBon,
                        'nominal_terbayarkan' => $bonCuttingAmbil->nominal_terbayarkan + $nominalBayarBon,
                        'status' => 'terbayarkan',
                    ]);
                } else {
                    $bonCuttingAmbil->update([
                        'nominal_belum_terbayarkan' => '0',
                        'nominal_terbayarkan' => $bonCuttingAmbil->nominal_terbayarkan + abs(abs($hitungBon) - $nominalBayarBon),
                        'status' => 'lunas',
                    ]);
                    $messages[] = 'Ada sisa kembalian bon sebesar ' . formatRupiah(abs($hitungBon));
                }
            } else {
                $bonKeseluruhan = Bon::where('id_karyawan', $id_karyawan)
                    ->whereIn('status', ['terbayarkan', 'belum terbayarkan'])
                    ->get();
                $hitungBon = $bonKeseluruhan->nominal_belum_terbayarkan - $nominalBayarBon;
                if ($hitungBon == 0) {
                    $bonKeseluruhan->update([
                        'nominal_belum_terbayarkan' => $hitungBon,
                        'nominal_terbayarkan' => $bonKeseluruhan->nominal_terbayarkan + $nominalBayarBon,
                        'status' => 'lunas',
                    ]);
                } else if ($hitungBon > 0) {
                    $bonKeseluruhan->update([
                        'nominal_belum_terbayarkan' => $bonKeseluruhan->nominal_belum_terbayarkan - $nominalBayarBon,
                        'nominal_terbayarkan' => $bonKeseluruhan->nominal_terbayarkan + $nominalBayarBon,
                        'status' => 'terbayarkan',
                    ]);
                } else {
                    $bonKeseluruhan->update([
                        'nominal_belum_terbayarkan' => '0',
                        'nominal_terbayarkan' => $bonKeseluruhan->nominal_terbayarkan + abs(abs($hitungBon) - $nominalBayarBon),
                        'status' => 'lunas',
                    ]);
                    $messages[] = 'Ada sisa kembalian bon sebesar ' . formatRupiah(abs($hitungBon));
                }
            }
        }

        if ($request->boolean('lbayar')) {
            $validator = Validator::make($request->all(), [
                'nominal_bayar' => 'required|decimal:3',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $nominalBayar = (int) Str::of($request->nominal_bayar)->remove('.')->toString();

            if ($nominalBayar > $kalkulasi) {
                return response()->json(['errors' => 'Nominal bayar tidak boleh melebihi kalkulasi'], 422);
            }

            $nominalTerbayarkan = $request->boolean('allbayar') || $nominalBayar == $kalkulasi ? $kalkulasi : $nominalBayar;

            Gaji::create([
                'id_karyawan' => $id_karyawan,
                'cutting_ambil' => $cuttingAmbil->id,
                'cutting_kembali' => $cuttingKembali->id,
                'nominal' => $kalkulasi,
                'nominal_terbayarkan' => $nominalTerbayarkan,
                'nominal_belum_terbayarkan' => $kalkulasi - $nominalTerbayarkan,
                'status' => $nominalTerbayarkan == $kalkulasi ? 'lunas' : 'terbayarkan',
            ]);
        } else {
            $nominalBayar = (int) Str::of($request->nominal_bayar)->remove('.')->toString();

            if ($nominalBayar > $kalkulasi) {
                return response()->json(['errors' => 'Nominal bayar tidak boleh melebihi kalkulasi'], 422);
            }

            Gaji::create([
                'id_karyawan' => $id_karyawan,
                'cutting_ambil' => $cuttingAmbil->id,
                'cutting_kembali' => $cuttingKembali->id,
                'nominal' => $kalkulasi,
                'nominal_terbayarkan' => '0',
                'nominal_belum_terbayarkan' => $kalkulasi,
                'status' => 'belum terbayarkan',
            ]);
        }

        $messages[] = 'Data berhasil disimpan';
        return response()->json(['success' => $messages], 200);
    }

    public function statusGaji(Request $request)
    {
        $gaji = Gaji::find($request->post_id);

        $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:gaji,id',
            'nominal_bayar_gaji' => 'required|decimal:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $nominalBayar = (int) Str::of($request->nominal_bayar_gaji)->remove('.')->toString();
        $kalkulasi = $gaji->nominal_belum_terbayarkan - $nominalBayar;
        if ($nominalBayar >  $gaji->nominal_belum_terbayarkan) {
            return response()->json(['errors' => 'Nominal bayar tidak boleh melebihi kalkulasi'], 422);
        }

        if ($request->boolean('allbayar') || $kalkulasi == 0) {
            $gaji->update([
                'nominal_terbayarkan' => $gaji->nominal_terbayarkan + $nominalBayar,
                'nominal_belum_terbayarkan' => '0',
                'status' => 'lunas',
            ]);
        } else if ($kalkulasi > 0) {
            $gaji->update([
                'nominal_terbayarkan' => $gaji->nominal_terbayarkan + $nominalBayar,
                'nominal_belum_terbayarkan' => $gaji->nominal_belum_terbayarkan - $nominalBayar,
                'status' => 'terbayarkan',
            ]);
        } else {
            $gaji->update([
                'nominal_terbayarkan' => $gaji->nominal_terbayarkan + abs(abs($kalkulasi) - $kalkulasi),
                'nominal_belum_terbayarkan' => '0',
                'status' => 'lunas',
            ]);
            $messages[] = 'Ada sisa lebih bayar sebesar ' . formatRupiah(abs($kalkulasi));
        }

        $messages[] = 'Data berhasil disimpan';
        return response()->json(['success' => $messages], 200);
    }
}

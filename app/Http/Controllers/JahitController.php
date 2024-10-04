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
use App\Models\Gaji;
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
                $jahitWarnaModel = JahitWarnaModel::create([
                    'id_ambil_model' => $ambilModel->id,
                    'warna' => $warnaData['warna'],
                    'jumlah_ambil' => $warnaData['jumlah_ambil'],
                    'satuan_ambil' => $warnaData['satuan_ambil'],
                    'ongkos' => $warnaData['ongkos'],
                ]);
            }
        }

        if ($request->nominal_bon && $request->nominal_bon != 0) {
            Bon::create([
                'id_karyawan' => $karyawan->id,
                'jahit_ambil' => $jahit_ambil->id,
                'nominal' => $request->nominal_bon,
                'nominal_belum_terbayarkan' => $request->nominal_bon,
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

    public function postKembaliJahit(Request $request, $id_karyawan, $id_warna)
    {
        $warnaModelKembali = JahitWarnaModel::find($id_warna);
        if (!$warnaModelKembali) {
            return response()->json(['error' => 'Warna model tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:jahit_warna_model,id',
            'jumlah_kembali' => 'required|integer',
            'satuan_kembali' => 'required|string',
            'tanggal_kembali' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kalkulasi = $request->jumlah_kembali * $warnaModelKembali->ongkos;

        $jahitKembali = JahitKembali::create([
            'id_jahit_warna_model' => $warnaModelKembali->id,
            'jumlah_kembali' => $request->jumlah_kembali,
            'satuan_kembali' => $request->satuan_kembali ?: 'pcs',
            'total_ongkos' => $kalkulasi,
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        $jahitAmbilModel = JahitAmbilModel::whereId($warnaModelKembali->id_ambil_model)->first();
        $jahitAmbil = JahitAmbil::whereId($jahitAmbilModel->id_jahit_ambil)->first();

        $bonJahitAmbil = Bon::where('jahit_ambil', $jahitAmbil->id)
            ->whereIn('status', ['terbayarkan', 'belum terbayarkan'])
            ->first();

        if ($request->boolean('bbon')) {
            $validator = Validator::make($request->all(), [
                'nominal_bayar_bon' => 'required',
                'nominal_bayar' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $nominalBayarBon = (int) Str::of($request->nominal_bayar_bon)->remove('.')->toString();
            if ($bonJahitAmbil) {
                $hitungBon = $bonJahitAmbil->nominal_belum_terbayarkan - $nominalBayarBon;
                if ($hitungBon == 0) {
                    $bonJahitAmbil->update([
                        'nominal_belum_terbayarkan' => $hitungBon,
                        'nominal_terbayarkan' => $bonJahitAmbil->nominal_terbayarkan + $nominalBayarBon,
                        'status' => 'lunas',
                    ]);
                } else if ($hitungBon > 0) {
                    $bonJahitAmbil->update([
                        'nominal_belum_terbayarkan' => $bonJahitAmbil->nominal_belum_terbayarkan - $nominalBayarBon,
                        'nominal_terbayarkan' => $bonJahitAmbil->nominal_terbayarkan + $nominalBayarBon,
                        'status' => 'terbayarkan',
                    ]);
                } else {
                    $bonJahitAmbil->update([
                        'nominal_belum_terbayarkan' => '0',
                        'nominal_terbayarkan' => $bonJahitAmbil->nominal_terbayarkan + abs(abs($hitungBon) - $nominalBayarBon),
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
                'nominal_bayar' => 'required',
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
                'jahit_ambil' => $jahitAmbil->id,
                'jahit_kembali' => $jahitKembali->id,
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
                'jahit_ambil' => $jahitAmbil->id,
                'jahit_kembali' => $jahitKembali->id,
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
            'nominal_bayar_gaji' => 'required',
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

    public function deleteJahit($id) {
        $jahitAmbil  = JahitAmbil::find($id);
        $jahitAmbil->delete();
        return redirect()->back()->with('success', 'Berhasil dihapus');
    }

    public function modelDelete($id) {
        $jahitAmbilModel  = JahitAmbilModel::find($id);
        $jahitAmbilModel->delete();
        return redirect()->back()->with('success', 'Berhasil dihapus');
    }

    public function warnaDelete($id) {
        $jahitWarnaModel  = JahitWarnaModel::find($id);
        $jahitWarnaModel->delete();
        return redirect()->back()->with('success', 'Berhasil dihapus');
    }
}

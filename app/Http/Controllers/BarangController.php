<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bon;
use App\Models\Kain;
use App\Models\Jahit;
use App\Models\Warna;
use App\Models\Models;
use App\Models\Cutting;
use App\Models\Supplyer;
use App\Models\BarangJadi;
use App\Models\WarnaModel;
use Illuminate\Support\Str;
use App\Models\BarangMentah;
use App\Models\KainBarangMentah;
use Illuminate\Http\Request;
use App\Models\ModelBarangJadi;
use App\Models\WarnaKain;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    // Proses Barang mentah

    public function getMentah($id)
    {
        $data = [
            'supplyer' => Supplyer::find($id),
            'kain' => Kain::orderBy('id', 'desc')->get(),
        ];
        return view('pages.barang.mentah.index', $data);
    }
    public function storeMentah(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_datang' => 'required',
            'supplyer_id' => 'required',
            'unique_id' => 'required'
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

        foreach ($request->kain as $kainData) {

            $barang_mentah = BarangMentah::create([
                'supplyer_id' => $request->supplyer_id,
                'tanggal_datang' => $request->tanggal_datang,
                'unique_id' => $request->unique_id,
            ]);

            $kain_mentah = KainBarangMentah::create([
                'barang_mentah_id' => $barang_mentah->id,
                'kain' => $kainData['nama'],
            ]);

            foreach ($kainData['warna'] as $warnaData) {
                WarnaKain::create([
                    'kain_mentah_id' => $kain_mentah->id,
                    'warna' => '-',
                    'jumlah' => $warnaData['jumlah_mentah'],
                    'satuan' => $warnaData['satuan'],
                    'harga' => $warnaData['harga'],
                    'total' => $warnaData['total'],
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

    public function updateMentahById(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'tanggal_datang' => 'required',
            'supplyer_id' => 'required',
            'unique_id' => 'required'
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

        $barang_mentah = BarangMentah::find($id);

        if (!$barang_mentah) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data barang mentah tidak ditemukan',
                ],
                404,
            );
        }

        $barang_mentah->update([
            'supplyer_id' => $request->supplyer_id,
            'tanggal_datang' => $request->tanggal_datang,
            'unique_id' => $request->unique_id,
        ]);

        foreach ($request->kain as $kainData) {
            $kain_mentah = KainBarangMentah::where('barang_mentah_id', $barang_mentah->id)
                ->where('id', $kainData['id'])
                ->first();

            if ($kain_mentah) {
                $kain_mentah->update([
                    'kain' => $kainData['nama'],
                ]);
            } else {
                $kain_mentah = KainBarangMentah::create([
                    'barang_mentah_id' => $barang_mentah->id,
                    'kain' => $kainData['nama'],
                ]);
            }

            foreach ($kainData['warna'] as $warnaData) {
                $warna_kain = WarnaKain::where('kain_mentah_id', $kain_mentah->id)
                    ->where('id', $warnaData['id'])
                    ->first();

                if ($warna_kain) {
                    $warna_kain->update([
                        'warna' => '-',
                        'jumlah' => $warnaData['jumlah_mentah'],
                        'satuan' => $warnaData['satuan'],
                        'harga' => $warnaData['harga'],
                        'total' => $warnaData['total'],
                    ]);
                } else {
                    WarnaKain::create([
                        'kain_mentah_id' => $kain_mentah->id,
                        'warna' => '-',
                        'jumlah' => $warnaData['jumlah_mentah'],
                        'satuan' => $warnaData['satuan'],
                        'harga' => $warnaData['harga'],
                        'total' => $warnaData['total'],
                    ]);
                }
            }
        }

        return response()->json(
            [
                'success' => true,
                'message' => 'Data berhasil diperbarui',
            ],
            200,
        );
    }


    public function editResponseMentah($id)
    {
        return response()->json([
            'success' => true,
            'data' => BarangMentah::findOrFail($id),
        ]);
    }

    public function updateMentah(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'tanggal_datang' => 'required',
        ]);

        BarangMentah::findOrFail($request->id)->update([
            'tanggal_datang' => $request->tanggal_datang,
        ]);

        return redirect()->back()->with('success', 'Barang Mentah Berhasil Diupdate');
    }

    public function destroyMentah($id)
    {
        $barang = BarangMentah::find($id);
        $barang->delete();
        return redirect()->back()->with('success', 'Barang Mentah Berhasil Dihapus.');
    }

    // proses Barang Jadi atau kirim -----------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function getPengiriman($unique)
    {
        $barangMentah = BarangMentah::with(['kainBarangMentah.warnaKain'])
            ->where('unique_id', $unique)
            ->latest();
        $data = [
            // 'supplyer' => Supplyer::find($id),
            'barangMentahGet' => $barangMentah->get()->groupBy('unique_id'),
            'barangMentahFirst' => $barangMentah->with('supplyer')->first(),
            'model' => Models::orderBy('id', 'desc')->get(),
            'warna' => Warna::orderBy('id', 'desc')->get(),
        ];
        // dd($data);
        return view('pages.barang.jadi.index', $data);
    }

    public function storeJadi(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'tanggal_kirim' => 'required',
            'supplyer_id' => 'required',
            'unique_id' => 'required',
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


        foreach ($request->model as $modelData) {

            $barang_jadi = BarangJadi::create([
                'supplyer_id' => $request->supplyer_id,
                'unique_id' => $request->unique_id,
                'tanggal_kirim' => $request->tanggal_kirim,
            ]);

            $model_barang_jadi = ModelBarangJadi::create([
                'barang_jadi_id' => $barang_jadi->id,
                'model' => $modelData['nama'],
            ]);

            foreach ($modelData['warna'] as $warnaData) {
                WarnaModel::create([
                    'model_barang_jadi_id' => $model_barang_jadi->id,
                    'warna' => '-',
                    'jumlah' => $warnaData['jumlah_jadi'],
                    'satuan' => $warnaData['satuan'],
                    'harga' => $warnaData['harga'],
                    'total' => $warnaData['total'],
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

    public function updateJadiById(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'tanggal_kirim' => 'required',
            'supplyer_id' => 'required',
            'unique_id' => 'required',
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

        // Loop melalui setiap model yang diterima dari request
        foreach ($request->model as $modelData) {

            // Update atau buat data BarangJadi
            $barang_jadi = BarangJadi::updateOrCreate(
                [
                    'unique_id' => $request->unique_id,
                ],
                [
                    'supplyer_id' => $request->supplyer_id,
                    'tanggal_kirim' => $request->tanggal_kirim,
                ]
            );

            // Update atau buat data ModelBarangJadi
            $model_barang_jadi = ModelBarangJadi::updateOrCreate(
                [
                    'barang_jadi_id' => $barang_jadi->id, // Berdasarkan barang_jadi_id
                    'model' => $modelData['nama'],         // Berdasarkan nama model
                ]
            );

            // Loop melalui setiap warna yang terkait dengan model
            foreach ($modelData['warna'] as $warnaData) {
                WarnaModel::updateOrCreate(
                    [
                        'model_barang_jadi_id' => $model_barang_jadi->id, // Berdasarkan model_barang_jadi_id
                        'id' => $warnaData['id'], // Menggunakan ID untuk mencari data
                    ],
                    [
                        'warna' => '-', // Kamu bisa mengganti '-' ini dengan nilai yang relevan
                        'jumlah' => $warnaData['jumlah_jadi'],
                        'satuan' => $warnaData['satuan'],
                        'harga' => $warnaData['harga'],
                        'total' => $warnaData['total'],
                    ]
                );
            }
        }

        // Kembalikan respons sukses
        return response()->json(
            [
                'success' => true,
            ],
            200,
        );
    }


    public function editResponseJadi($id)
    {
        return response()->json([
            'success' => true,
            'data' => BarangJadi::findOrFail($id),
        ]);
    }

    public function updateJadi(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'tanggal_kirim' => 'required',
        ]);

        BarangJadi::findOrFail($request->id)->update([
            'tanggal_kirim' => $request->tanggal_kirim,
        ]);

        return redirect()->back()->with('success', 'Tanggal Barang Jadi Berhasil Diupdate');
    }

    public function destroyJadi($id)
    {
        $barang = BarangJadi::find($id);
        $barang->delete();
        return redirect()->back()->with('success', 'Barang Jadi Berhasil Dihapus.');
    }

    // print
    public function print($id)
    {
        $data = [
            'barang' => BarangMentah::findOrFail($id),
            'kain' => Kain::all(),
            'model' => Models::all(),
            'warna' => Warna::all(),
            'supplyer' => Supplyer::all(),
        ];
        return view('barang.print', $data);
    }
}

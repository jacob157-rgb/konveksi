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
            'warna' => Warna::orderBy('id', 'desc')->get(),
            'kain' => Kain::orderBy('id', 'desc')->get(),
        ];
        return view('pages.barang.mentah.index', $data);
    }
    public function storeMentah(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_datang' => 'required',
            'supplyer_id' => 'required',
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

        $barang_mentah = BarangMentah::create([
            'supplyer_id' => $request->supplyer_id,
            'tanggal_datang' => $request->tanggal_datang,
        ]);

        foreach ($request->kain as $kainData) {
            $kain_mentah = KainBarangMentah::create([
                'barang_mentah_id' => $barang_mentah->id,
                'kain' => $kainData['nama'],
            ]);

            foreach ($kainData['warna'] as $warnaData) {
                WarnaKain::create([
                    'kain_mentah_id' => $kain_mentah->id,
                    'warna' => $warnaData['warna'],
                    'jumlah' => Str::of($warnaData['jumlah_mentah'])->remove('.'),
                    'satuan' => Str::of($warnaData['satuan'])->remove('.'),
                    'harga' => Str::of($warnaData['harga'])->remove('.'),
                    'total' => Str::of($warnaData['total'])->remove('.'),
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

    // proses Barang Jadi atau kirim

    public function getJadi($id)
    {
        $data = [
            'supplyer' => Supplyer::find($id),
            'model' => Models::orderBy('id', 'desc')->get(),
            'warna' => Warna::orderBy('id', 'desc')->get(),
        ];
        return view('pages.barang.jadi.index', $data);
    }

    public function storeJadi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_kirim' => 'required',
            'supplyer_id' => 'required',
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

        $barang_jadi = BarangJadi::create([
            'supplyer_id' => $request->supplyer_id,
            'tanggal_kirim' => $request->tanggal_kirim,
        ]);

        foreach ($request->model as $modelData) {
            $model_barang_jadi = ModelBarangJadi::create([
                'barang_jadi_id' => $barang_jadi->id,
                'model' => $modelData['nama'],
            ]);

            foreach ($modelData['warna'] as $warnaData) {
                WarnaModel::create([
                    'model_barang_jadi_id' => $model_barang_jadi->id,
                    'warna' => $warnaData['warna'],
                    'jumlah' => Str::of($warnaData['jumlah_jadi'])->remove('.'),
                    'satuan' => Str::of($warnaData['satuan'])->remove('.'),
                    'harga' => Str::of($warnaData['harga'])->remove('.'),
                    'total' => Str::of($warnaData['total'])->remove('.'),
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
            'jahit' => Jahit::orderBy('id', 'desc')->where('barang_id', $id)->get(),
            'cutting' => Cutting::orderBy('id', 'desc')->where('barang_id', $id)->get(),
        ];
        return view('barang.print', $data);
    }
}

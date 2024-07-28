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
use App\Models\BarangMentah;
use App\Models\ModelBarangJadi;
use App\Models\WarnaModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Model;

class BarangController extends Controller
{
    // Proses Barang mentah
    public function storeMentah(Request $request)
    {
        $request->validate([
            'supplyer_id' => 'required',
            'kain_id' => 'required',
            'jumlah_mentah' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
            'tanggal_datang' => 'required',
        ]);

        BarangMentah::create([
            'supplyer_id' => $request->supplyer_id,
            'kain_id' => $request->kain_id,
            'jumlah_mentah' => $request->jumlah_mentah,
            'satuan' => $request->satuan,
            'harga' => str_replace('.', '', $request->harga),
            'tanggal_datang' => $request->tanggal_datang,
        ]);

        return redirect('/supplyer')->with('success', 'Barang Mentah Mentah Berhasil Ditambahkan.');
    }

    public function editResponseMentah($id)
    {
        return response()->json([
            'success' => true,
            'barang' => BarangMentah::findOrFail($id),
            'kain' => Kain::all(),
        ]);
    }

    public function updateMentah(Request $request)
    {
        $request->validate([
            'supplyer_id' => 'required',
            'kain_id' => 'required',
            'jumlah_mentah' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
            'tanggal_datang' => 'required',
        ]);

        BarangMentah::findOrFail($request->id)->update([
            'supplyer_id' => $request->supplyer_id,
            'kain_id' => $request->kain_id,
            'jumlah_mentah' => $request->jumlah_mentah,
            'satuan' => $request->satuan,
            'harga' => str_replace('.', '', $request->harga),
            'tanggal_datang' => $request->tanggal_datang,
        ]);

        return redirect()->back()->with('success', 'Barang Mentah Berhasil Diupdate');
    }

    public function destroyMentah($id)
    {
        $barang = BarangMentah::find($id);
        $barang->delete();
        return redirect()->back()->with('success', 'Barang Mentah Dihapus.');
    }

    // proses Barang Jadi atau kirim

    public function getJadi($id) {
        $data = [
            'supplyer' => Supplyer::find($id),
            'model' => Models::orderBy('id', 'desc')->get(),
            'warna' => Warna::orderBy('id', 'desc')->get()
        ];
        return view('pages.barang.jadi.index', $data);
    }
    public function storeJadi(Request $request)
    {
        dd($request->all());
        $request->validate([
            // tanggal kirim
            'tanggal_kirim' => 'required',
            'supplyer_id' => 'required',
            // model barang jadi
            'model' => 'required',
            // warna
            'warna' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'total' => 'required',
        ]);

        $barang_jadi = BarangJadi::create([
            'supplyer_id' => $request->supplyer_id,
            'tanggal_kirim' => $request->tanggal_kirim,
        ]);

        $model_barang_jadi = ModelBarangJadi::create([
            'barang_jadi_id' => $barang_jadi->id,
            'model' => $request->model,
        ]);

        $warna_model = WarnaModel::create([
            'model_barang_jadi_id' => $model_barang_jadi->id,
            'warna' => $request->warna,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'total' => $request->total,
        ]);

        return redirect('/supplyer')->with('success', 'Barang Jadi Berhasil Ditambahkan.');
    }

    public function editResponseJadi($id)
    {
        return response()->json([
            'success' => true,
            'barang' => BarangJadi::findOrFail($id),
            'model' => Model::all(),
            'warna' => Warna::all(),
        ]);
    }

    public function updateJadi(Request $request)
    {
        $request->validate([
            'supplyer_id' => 'required',
            'model_id' => 'required',
            'warna_id' => 'required',
            'jumlah_jadi' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
            'tanggal_kirim' => 'required',
        ]);

        BarangJadi::findOrFail($request->id)->update([
            'supplyer_id' => $request->supplyer_id,
            'model_id' => $request->model_id,
            'warna_id' => $request->warna_id,
            'jumlah_jadi' => $request->jumlah_jadi,
            'satuan' => $request->satuan,
            'harga' => str_replace('.', '', $request->harga),
            'tanggal_kirim' => $request->tanggal_kirim,
        ]);

        return redirect()->back()->with('success', 'Barang Jadi Berhasil Diupdate');
    }

    public function destroyJadi($id)
    {
        $barang = BarangJadi::find($id);
        $barang->delete();
        return redirect()->back()->with('success', 'Barang Jadi Dihapus.');
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

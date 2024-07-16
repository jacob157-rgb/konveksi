<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kain;
use App\Models\Jahit;
use App\Models\Warna;
use App\Models\Barang;
use App\Models\Bon;
use App\Models\Models;
use App\Models\Cutting;
use App\Models\Supplyer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BarangController extends Controller
{
    public function index()
    {
        $data = [
            'barang' => Barang::orderBy('id', 'desc')->get(),
        ];
        return view('barang.index', $data);
    }
    public function create()
    {
        $data = [
            'kain' => Kain::all(),
            'model' => Models::all(),
            'warna' => Warna::all(),
            'supplyer' => Supplyer::all(),
        ];
        return view('barang.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'supplyer_id' => 'required',
            'kain_id' => 'required',
            'model_id' => 'required',
            'warna_id' => 'required',
            'jumlah_mentah' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
            'tanggal_datang' => 'required',
        ]);

        Barang::create([
            'supplyer_id' => $request->supplyer_id,
            'kain_id' => $request->kain_id,
            'model_id' => $request->model_id,
            'warna_id' => $request->warna_id,
            'jumlah_mentah' => $request->jumlah_mentah,
            'jumlah_cutting' => 0,
            'jumlah_jahit' => 0,
            'satuan' => $request->satuan,
            'harga' => str_replace('.', '', $request->harga),
            'tanggal_datang' => $request->tanggal_datang,
            'tanggal_jadi' => null,
        ]);

        return redirect('/barang')->with('success', 'Barang Berhasil Ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'barang' => Barang::findOrFail($id),
            'kain' => Kain::all(),
            'model' => Models::all(),
            'warna' => Warna::all(),
            'supplyer' => Supplyer::all(),
        ];
        return view('barang.edit', $data);
    }
    public function show($id)
    {
        $data = [
            'barang' => Barang::findOrFail($id),
            'kain' => Kain::all(),
            'model' => Models::all(),
            'warna' => Warna::all(),
            'supplyer' => Supplyer::all(),
            'jahit' => Jahit::orderBy('id', 'desc')->where('barang_id', $id)->get(),
            'cutting' => Cutting::orderBy('id', 'desc')->where('barang_id', $id)->get(),
        ];
        return view('barang.show', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'supplyer_id' => 'required',
            'kain_id' => 'required',
            'model_id' => 'required',
            'warna_id' => 'required',
            'jumlah_mentah' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
            'tanggal_datang' => 'required',
        ]);

        Barang::findOrFail($id)->update([
            'supplyer_id' => $request->supplyer_id,
            'kain_id' => $request->kain_id,
            'model_id' => $request->model_id,
            'warna_id' => $request->warna_id,
            'jumlah_mentah' => $request->jumlah_mentah,
            'jumlah_cutting' => 0,
            'jumlah_jahit' => 0,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
            'tanggal_datang' => $request->tanggal_datang,
            'tanggal_jadi' => null,
        ]);

        return redirect('/barang')->with('success', 'Barang Berhasil Diupdate');
    }
    public function selesai(Request $request, $id)
    {
        Barang::findOrFail($id)->update([
            'tanggal_jadi' => Carbon::now(),
        ]);

        return redirect('/barang/show/'.$id)->with('success', 'Proses berhasil diselesaikan');
    }

    // pengembalian cutting
    public function getDetailPengembalianCutting($id_barang, $id_cutting)
    {
        $barang = Barang::findOrFail($id_barang);
        $cutting = Cutting::findOrFail($id_cutting);
        $data = [
            'barang' => $barang,
            'cutting' => $cutting,
        ];
        return view('barang.pengembalian.detail_cutting', $data);
    }
    public function getPengembalianCutting($id_barang, $id_cutting)
    {
        $barang = Barang::findOrFail($id_barang);
        $cutting = Cutting::findOrFail($id_cutting);
        $data = [
            'barang' => $barang,
            'cutting' => $cutting,
        ];
        return view('barang.pengembalian.cutting', $data);
    }
    public function postPengembalianCutting(Request $request, $id_barang, $id_cutting)
    {
        $barang = Barang::findOrFail($id_barang);
        $cutting = Cutting::findOrFail($id_cutting);
        $request->validate([
            'jumlah_kembali' => 'required',
            'bayar_ongkos' => 'required',
            'status_cutting' => 'required',
        ]);

        if ($cutting->tanggal_kembali) {
            $jumlah_cutting_sekarang = $barang->jumlah_cutting;
            $jumlah_kembali = $cutting->jumlah_kembali;
            $total = $jumlah_cutting_sekarang - $jumlah_kembali;
        } else {
            $total = $barang->jumlah_cutting;
        }

        $barang->update([
            'jumlah_cutting' => $total + $request->jumlah_kembali,
        ]);
        $cutting->update([
            'bayar_ongkos' => $request->bayar_ongkos,
            'tanggal_kembali' => Carbon::now(),
            'jumlah_kembali' => $request->jumlah_kembali,
            'status' => $request->status_cutting,
        ]);
        if ($request->status_bon) {
            $bon = Bon::getCutting($cutting->karyawan_id, $cutting->id);
            $bon->update([
                'status' => $request->status_bon,
            ]);
        }
        return redirect('/barang/show/' . $barang->id)->with('success', 'Data berhasil disimpan');
    }

    // pengembalian jahit
    public function getDetailPengembalianJahit($id_barang, $id_jahit)
    {
        $barang = Barang::findOrFail($id_barang);
        $jahit = Jahit::findOrFail($id_jahit);
        $data = [
            'barang' => $barang,
            'jahit' => $jahit,
        ];
        return view('barang.pengembalian.detail_jahit', $data);
    }
    public function getPengembalianJahit($id_barang, $id_jahit)
    {
        $barang = Barang::findOrFail($id_barang);
        $jahit = Jahit::findOrFail($id_jahit);
        $data = [
            'barang' => $barang,
            'jahit' => $jahit,
        ];
        return view('barang.pengembalian.jahit', $data);
    }
    public function postPengembalianJahit(Request $request, $id_barang, $id_jahit)
    {
        $barang = Barang::findOrFail($id_barang);
        $jahit = Jahit::findOrFail($id_jahit);
        $request->validate([
            'jumlah_kembali' => 'required',
            'bayar_ongkos' => 'required',
            'status_jahit' => 'required',
        ]);

        if ($jahit->tanggal_kembali) {
            $jumlah_jahit_sekarang = $barang->jumlah_jahit;
            $jumlah_kembali = $jahit->jumlah_kembali;
            $total = $jumlah_jahit_sekarang - $jumlah_kembali;
        } else {
            $total = $barang->jumlah_jahit;
        }

        $barang->update([
            'jumlah_jahit' => $total + $request->jumlah_kembali,
        ]);
        $jahit->update([
            'bayar_ongkos' => $request->bayar_ongkos,
            'tanggal_kembali' => Carbon::now(),
            'jumlah_kembali' => $request->jumlah_kembali,
            'status' => $request->status_jahit,
        ]);
        if ($request->status_bon) {
            $bon = Bon::getJahit($jahit->karyawan_id, $jahit->id);
            $bon->update([
                'status' => $request->status_bon,
            ]);
        }
        return redirect('/barang/show/' . $barang->id)->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);
        if ($barang->tanggal_jadi) {
            return redirect()->back()->with('error', 'Gagal Menghapus karena barang selesai.');
        }
        $barang->delete();
        return redirect()->back()->with('success', 'Barang Dihapus.');
    }
}

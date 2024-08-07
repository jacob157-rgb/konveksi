<?php

namespace App\Http\Controllers;

use App\Models\BarangJadi;
use Carbon\Carbon;
use App\Models\Kain;
use App\Models\Jahit;
use App\Models\Warna;
use App\Models\BarangMentah;
use App\Models\Bon;
use App\Models\Models;
use App\Models\Cutting;
use App\Models\Supplyer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BarangControllerOld extends Controller
{
    public function index(Request $request)
    {
        $datas = BarangMentah::latest()
            ->join('supplyer', 'barang.supplyer_id', '=', 'supplyer.id')
            ->join('kain', 'barang.kain_id', '=', 'kain.id')
            ->join('model', 'barang.model_id', '=', 'model.id')
            ->join('warna', 'barang.warna_id', '=', 'warna.id')
            ->select('barang.*', 'supplyer.nama as supplyer_nama', 'kain.nama as kain_nama', 'model.nama as model_nama', 'warna.nama as warna_nama');

        if (request()->input('query')) {
            $datas->where('supplyer.nama', 'like', '%' . request()->input('query') . '%')
                ->orWhere('kain.nama', 'like', '%' . request()->input('query') . '%')
                ->orWhere('tanggal_datang', 'like', '%' . request()->input('query') . '%')
                ->orWhere('model.nama', 'like', '%' . request()->input('query') . '%');
        }
        $data = [
            'barang' =>  $datas->orderBy('id', 'desc')->get(),
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

    public function storeJadi(Request $request)
    {
        // dd("jadi", $request);
        $request->validate([
            'supplyer_id' => 'required',
            'model_id' => 'required',
            'warna_id' => 'required',
            'jumlah_jadi' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
            'tanggal_kirim' => 'required',
        ]);

        BarangJadi::create([
            'supplyer_id' => $request->supplyer_id,
            'model_id' => $request->model_id,
            'warna_id' => $request->warna_id,
            'jumlah_jadi' => $request->jumlah_jadi,
            'satuan' => $request->satuan,
            'harga' => str_replace('.', '', $request->harga),
            'tanggal_kirim' => $request->tanggal_kirim,
        ]);

        return redirect('/supplyer')->with('success', 'Barang Jadi Berhasil Ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'barang' => BarangMentah::findOrFail($id),
            'kain' => Kain::all(),
            'model' => Models::all(),
            'warna' => Warna::all(),
            'supplyer' => Supplyer::all(),
        ];
        return view('barang.edit', $data);
    }
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
    public function show($id)
    {
        $cutting = Cutting::latest()
            ->join('karyawan', 'cutting.karyawan_id', '=', 'karyawan.id')
            ->select('cutting.*', 'karyawan.nama as nama_karyawan');

        if (request()->input('query')) {
            $cutting->where('karyawan.nama', 'like', '%' . request()->input('query') . '%')
                ->orWhere('jumlah_ambil', 'like', '%' . request()->input('query') . '%')
                ->orWhere('status', 'like', '%' . request()->input('query') . '%')
                ->orWhere('ongkos', 'like', '%' . request()->input('query') . '%')
                ->orWhere('jumlah_kembali', 'like', '%' . request()->input('query') . '%');
        }

        $jahit = Jahit::latest()
            ->join('karyawan', 'jahit.karyawan_id', '=', 'karyawan.id')
            ->select('jahit.*', 'karyawan.nama as nama_karyawan');

        if (request()->input('query')) {
            $jahit->where('karyawan.nama', 'like', '%' . request()->input('query') . '%')
                ->orWhere('jumlah_ambil', 'like', '%' . request()->input('query') . '%')
                ->orWhere('status', 'like', '%' . request()->input('query') . '%')
                ->orWhere('ongkos', 'like', '%' . request()->input('query') . '%')
                ->orWhere('jumlah_kembali', 'like', '%' . request()->input('query') . '%');
        }

        $data = [
            'barang' => BarangMentah::findOrFail($id),
            'kain' => Kain::all(),
            'model' => Models::all(),
            'warna' => Warna::all(),
            'supplyer' => Supplyer::all(),
            'jahit' => $jahit->orderBy('id', 'desc')->where('barang_id', $id)->get(),
            'cutting' => $cutting->orderBy('id', 'desc')->where('barang_id', $id)->get(),
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

        BarangMentah::findOrFail($id)->update([
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

        return redirect('/barang')->with('success', 'BarangMentah Berhasil Diupdate');
    }
    public function selesai(Request $request, $id)
    {
        BarangMentah::findOrFail($id)->update([
            'tanggal_jadi' => Carbon::now(),
        ]);

        return redirect('/barang/show/' . $id)->with('success', 'Proses berhasil diselesaikan');
    }

    // pengembalian cutting
    public function getDetailPengembalianCutting($id_barang, $id_cutting)
    {
        $barang = BarangMentah::findOrFail($id_barang);
        $cutting = Cutting::findOrFail($id_cutting);
        $data = [
            'barang' => $barang,
            'cutting' => $cutting,
        ];
        return view('barang.pengembalian.detail_cutting', $data);
    }
    public function getPengembalianCutting($id_barang, $id_cutting)
    {
        $barang = BarangMentah::findOrFail($id_barang);
        $cutting = Cutting::findOrFail($id_cutting);
        $data = [
            'barang' => $barang,
            'cutting' => $cutting,
        ];
        return view('barang.pengembalian.cutting', $data);
    }
    public function postPengembalianCutting(Request $request, $id_barang, $id_cutting)
    {
        $barang = BarangMentah::findOrFail($id_barang);
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
            'jumlah_cutting' => $total + str_replace('.', '', $request->jumlah_kembali),
        ]);
        $cutting->update([
            'bayar_ongkos' => str_replace('.', '', $request->bayar_ongkos),
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
        $barang = BarangMentah::findOrFail($id_barang);
        $jahit = Jahit::findOrFail($id_jahit);
        $data = [
            'barang' => $barang,
            'jahit' => $jahit,
        ];
        return view('barang.pengembalian.detail_jahit', $data);
    }
    public function getPengembalianJahit($id_barang, $id_jahit)
    {
        $barang = BarangMentah::findOrFail($id_barang);
        $jahit = Jahit::findOrFail($id_jahit);
        $data = [
            'barang' => $barang,
            'jahit' => $jahit,
        ];
        return view('barang.pengembalian.jahit', $data);
    }
    public function postPengembalianJahit(Request $request, $id_barang, $id_jahit)
    {
        $barang = BarangMentah::findOrFail($id_barang);
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
            'jumlah_jahit' => $total + str_replace('.', '', $request->jumlah_kembali),
        ]);
        $jahit->update([
            'bayar_ongkos' => str_replace('.', '', $request->bayar_ongkos),
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
        $barang = BarangMentah::find($id);
        if ($barang->tanggal_jadi) {
            return redirect()->back()->with('error', 'Gagal Menghapus karena barang selesai.');
        }
        $barang->delete();
        return redirect()->back()->with('success', 'BarangMentah Dihapus.');
    }
}

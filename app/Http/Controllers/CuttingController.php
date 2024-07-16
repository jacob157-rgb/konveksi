<?php

namespace App\Http\Controllers;

use App\Models\Kain;
use App\Models\Warna;
use App\Models\Barang;
use App\Models\Bon;
use App\Models\Models;
use App\Models\Cutting;
use App\Models\Karyawan;
use App\Models\Supplyer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CuttingController extends Controller
{
    public function index()
    {
        $data = [
            'cutting' => Cutting::orderBy('id', 'desc')->get(),
            'barang' => Barang::orderBy('id', 'desc')->get(),
        ];
        return view('cutting.index', $data);
    }
    public function create($id)
    {
        $data = [
            'barang' => Barang::find($id),
            'karyawan' => Karyawan::orderBy('id', 'desc')->where('jenis_karyawan', 'cutting')->get(),
        ];
        return view('cutting.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'karyawan_id' => 'required',
            'jumlah_ambil' => 'required',
            'satuan' => 'required',
            'ongkos' => 'required',
            'tanggal_ambil' => 'required',
        ]);

        $barang = Barang::find($request->barang_id);
        if ($barang->jumlah_mentah < $request->jumlah_ambil) {
            return redirect()->back()->with('error', 'Jumlah ambil melebihi jumlah mentah');
        }
        $cutting = Cutting::create([
            'barang_id' => $request->barang_id,
            'karyawan_id' => $request->karyawan_id,
            'jumlah_ambil' => $request->jumlah_ambil,
            'jumlah_kembali' => 0,
            'satuan' => $request->satuan,
            'ongkos' => $request->ongkos,
            'tanggal_ambil' => $request->tanggal_ambil,
            'tanggal_kembali' => null,
            'status' => 'proses',
        ]);
        if ($request->bon != null) {
            Bon::create([
                'karyawan_id' => $request->karyawan_id,
                'cutting_id' => $cutting->id,
                'nominal' => $request->bon,
                'status' => 'belumlunas',
            ]);
        }
        return redirect('/cutting')->with('success', 'Cutting created successfully.');
    }

    public function destroy($id)
    {
        $cutting = Cutting::find($id);
        if ($cutting->status == 'jadi' || $cutting->tanggal_kembali || $cutting->jumlah_kembali != 0) {
            return redirect()->back()->with('error', 'Gagal Menghapus karena barang sudah jadi.');
        }
        $cutting->delete();
        return redirect()->back()->with('success', 'Cutting delete successfully.');
    }
}

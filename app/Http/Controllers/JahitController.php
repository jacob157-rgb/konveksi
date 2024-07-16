<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Bon;
use App\Models\Jahit;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class JahitController extends Controller
{
    public function index()
    {
        $data = [
            'jahit' => Jahit::orderBy('id', 'desc')->get(),
            'barang' => Barang::orderBy('id', 'desc')->get(),
        ];
        return view('jahit.index', $data);
    }
    public function create($id)
    {
        $data = [
            'barang' => Barang::find($id),
            'karyawan' => Karyawan::orderBy('id', 'desc')->where('jenis_karyawan', 'jahit')->get(),
        ];
        return view('jahit.create', $data);
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

        $jahit = Jahit::create([
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
                'jahit_id' => $jahit->id,
                'nominal' => $request->bon,
                'status' => 'belumlunas',
            ]);
        }
        return redirect('/jahit')->with('success', 'Jahit created successfully.');
    }

    public function destroy($id)
    {
        $jahit = Jahit::find($id);
        if ($jahit->status == 'jadi' || $jahit->tanggal_kembali || $jahit->jumlah_kembali != 0) {
            return redirect()->back()->with('error', 'Gagal Menghapus karena barang sudah jadi.');
        }
        $jahit->delete();
        return redirect()->back()->with('success', 'Jahit delete successfully.');
    }
}

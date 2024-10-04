<?php

namespace App\Http\Controllers;

use App\Models\BarangMentah;
use App\Models\Selisih;
use Illuminate\Http\Request;

class SelisihController extends Controller
{
    public function index($unique)
    {
        $data = [
            'unique' => $unique,
        ];
        return view('pages.selisih.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'unique_id' => 'required',
            'tanggal' => 'required',
            'nominal' => 'required',
        ]);
        $barang = BarangMentah::where('unique_id', $request->unique_id)->first();

        Selisih::create([
            'tanggal' => $request->tanggal,
            'unique_id' => $request->unique_id,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect("supplyer/detail/$barang->supplyer_id")->with('success', 'Selisih berhasil dibuat');
    }

    public function edit($id)
    {
        $data = [
            'selisih' => Selisih::find($id)
        ];

        return view('pages.selisih.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
            'nominal' => 'required',
        ]);

        $selisih = Selisih::find($id);
        $barang = BarangMentah::where('unique_id', $selisih->unique_id)->first();

        $selisih->update([
            'tanggal' => $request->tanggal,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect("supplyer/detail/$barang->supplyer_id")->with('success', 'Selisih berhasil diedit');
    }

    public function delete($id)
    {
        $selisih = Selisih::find($id);
        $selisih->delete();
        return redirect()->back()->with('success', 'Berhasil dihapus');

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $data = [
            'pengeluaran' => Pengeluaran::orderBy('id', 'desc')->get(),
        ];
        // dd('view pengeluaran durung digawe ya jac, ikuti route, datane tampilna nominal, keterangan, karo update_at tampilna. ganti format',$data);
        return view('pengeluaran.index', $data);
    }
    public function create()
    {
        return view('pengeluaran.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nominal' => 'required',
            'keterangan' => 'required',
        ]);

        Pengeluaran::create([
            'nominal' => str_replace('.', '', $request->nominal),
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/pengeluaran')->with('success', 'Catatan berhasil disimpan');
    }
    public function edit($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        return view('pengeluaran.edit', compact('pengeluaran'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required',
            'keterangan' => 'required',
        ]);

        Pengeluaran::find($id)->update([
            'nominal' => str_replace('.', '', $request->nominal),
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/pengeluaran')->with('success', 'Catatan berhasil diupdate');
    }
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->delete();
        return redirect('/pengeluaran')->with('success', 'Catatan berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index(Request $request)
    {
        $datas = Pengeluaran::latest();
        if (request()->input('query')) {
            $datas->where('nominal', 'like', '%' . request()->input('query') . '%')->orWhere('keterangan', 'like', '%' . request()->input('query') . '%');
        }
        if (request()->input('start_date') && request()->input('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $datas->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate);
        }
        $data = [
            'pengeluaran' => $datas->orderBy('id', 'desc')->get(),
            'total_nominal' => $datas->sum('nominal'),
        ];
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

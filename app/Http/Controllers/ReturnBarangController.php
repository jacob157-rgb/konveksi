<?php

namespace App\Http\Controllers;

use App\Models\BarangMentah;
use App\Models\Models;
use App\Models\ReturnBarang;
use Illuminate\Http\Request;

class ReturnBarangController extends Controller
{
    public function index($unique)
    {
        $data = [
            'unique' => $unique,
            'model' => Models::all(),
        ];
        return view('pages.return.index', $data);
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'unique_id' => 'required',
            'tanggal' => 'required',
            'model' => 'required|array',
            'jumlah' => 'required|array',
            'harga' => 'required|array',
            'total' => 'required|array',
        ]);

        $barang = BarangMentah::where('unique_id', $request->unique_id)->first();

        foreach ($request->model as $index => $model) {
            ReturnBarang::create([
                'tanggal' => $request->tanggal,
                'unique_id' => $request->unique_id,
                'model' => $model,
                'jumlah' => $request->jumlah[$index],
                'harga' => $request->harga[$index],
                'total' => $request->total[$index],
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect("supplyer/detail/{$barang->supplyer_id}")->with('success', 'Return Barang berhasil dibuat');
    }

    public function edit($id)
    {
        $data = [
            'return' => ReturnBarang::find($id),
            'model' => Models::all(),
        ];
        return view('pages.return.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'unique_id' => 'required',
            'tanggal' => 'required',
            'model' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'total' => 'required',
        ]);

        $return = ReturnBarang::find($id);
        $barang = BarangMentah::where('unique_id', $return->unique_id)->first();

        $return->update([
            'tanggal' => $request->tanggal,
            'unique_id' => $request->unique_id,
            'model' => $request->model,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'total' => $request->total,
        ]);

        return redirect("supplyer/detail/$barang->supplyer_id")->with('success', 'Return Barang berhasil diedit');
    }

    public function delete($id)
    {
        $return = ReturnBarang::find($id);
        $return->delete();
        return redirect()->back()->with('success', 'Berhasil dihapus');
    }
}

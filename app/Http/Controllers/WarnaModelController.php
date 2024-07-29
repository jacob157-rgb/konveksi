<?php

namespace App\Http\Controllers;

use App\Models\WarnaModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class WarnaModelController extends Controller
{
    public function edit($id)
    {
        return response()->json([
            'success' => true,
            'data' => WarnaModel::find($id),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'warna' => 'required|string|max:255',
            'jumlah' => 'required|string|max:255',
            'harga' => 'required|string|max:255',
            'total' => 'required|string|max:255',
        ]);

        $warna = WarnaModel::find($request->id);
        $warna::update([
            'warna' => $request->warna,
            'jumlah' => Str::of($request->jumlah_jadi)->remove('.'),
            'satuan' => Str::of($request->satuan)->remove('.'),
            'harga' => Str::of($request->harga)->remove('.'),
            'total' => Str::of($request->total)->remove('.'),
        ]);
        return redirect()->back()->with('success', 'Warna Model Berhasil Diupdate.');
    }

    public function destroy($id)
    {
        $barang = WarnaModel::find($id);
        $barang->delete();
        return redirect()->back()->with('success', 'Warna Model Jadi Dihapus.');
    }
}

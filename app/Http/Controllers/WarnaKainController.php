<?php

namespace App\Http\Controllers;

use App\Models\WarnaKain;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class WarnaKainController extends Controller
{
    public function edit($id)
    {
        return response()->json([
            'success' => true,
            'data' => WarnaKain::find($id),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'warna' => 'required|string|max:255',
            'jumlah' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'harga' => 'required|string|max:255',
            'total' => 'required|string|max:255',
        ]);

        $warna = WarnaKain::find($request->id);
        $warna->update([
            'warna' => $request->warna,
            'jumlah' => Str::of($request->jumlah)->remove('.'),
            'satuan' => $request->satuan,
            'harga' => Str::of($request->harga)->remove('.'),
            'total' => Str::of($request->total)->remove('.'),
        ]);
        return redirect()->back()->with('success', 'Warna Kain Berhasil Diupdate.');
    }

    public function destroy($id)
    {
        $barang = WarnaKain::find($id);
        $barang->delete();
        return redirect()->back()->with('success', 'Warna Kain Jadi Dihapus.');
    }
}

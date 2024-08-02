<?php

namespace App\Http\Controllers;

use App\Models\KainBarangMentah;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\WarnaKain;

class KainMentahController extends Controller
{
    public function edit($id)
    {
        return response()->json([
            'success' => true,
            'data' => KainBarangMentah::find($id),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'kain' => 'required|string|max:255',
        ]);

        $kainMentah = KainBarangMentah::find($request->id);
        $kainMentah->update([
            'kain' => $request->kain,
        ]);
        return redirect()->back()->with('success', 'Kain Berhasil Diupdate.');
    }

    public function destroy($id)
    {
        $barang = KainBarangMentah::find($id);
        $barang->delete();
        return redirect()->back()->with('success', 'Kain Jadi Dihapus.');
    }
}

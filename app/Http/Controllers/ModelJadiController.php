<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ModelBarangJadi;

class ModelJadiController extends Controller
{
    public function edit($id)
    {
        return response()->json([
            'success' => true,
            'data' => ModelBarangJadi::find($id),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'model' => 'required|string|max:255',
        ]);

        $modelBarangJadi = ModelBarangJadi::find($request->id);
        $modelBarangJadi::update([
            'model' => $request->model,
        ]);
        return redirect()->back()->with('success', 'Model Berhasil Diupdate.');
    }

    public function destroy($id)
    {
        $barang = ModelBarangJadi::find($id);
        $barang->delete();
        return redirect()->back()->with('success', 'Model Jadi Dihapus.');
    }
}

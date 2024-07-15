<?php

namespace App\Http\Controllers;

use App\Models\Kain;
use Illuminate\Http\Request;

class KainController extends Controller
{
    public function index()
    {
        $data = [
            'kain' => Kain::orderBy('id', 'desc')->get(),
        ];
        return view('kain.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kain = new Kain();
        $kain->nama = $request->nama;
        $kain->save();

        return redirect()->back()->with('success', 'Kain Berhasil Ditambahkan.');
    }

    public function edit($id)
    {
        return response()->json([
            'success' => true,
            'data' => Kain::find($id),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nama' => 'required|string|max:255',
        ]);

        $kain = Kain::find($request->id);
        $kain->nama = $request->nama;
        $kain->save();

        return redirect()->back()->with('success', 'Kain Berhasil Diupdate.');
    }

    public function destroy($id)
    {
        $supplyer = Kain::find($id);
        $supplyer->delete();
        return redirect()->back()->with('success', 'Kain Dihapus.');
    }
}

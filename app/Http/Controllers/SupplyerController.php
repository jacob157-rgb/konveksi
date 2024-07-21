<?php

namespace App\Http\Controllers;

use App\Models\Supplyer;
use Illuminate\Http\Request;

class SupplyerController extends Controller
{
    public function index(Request $request)
    {

        $datas = Supplyer::latest();
        if (request()->input('query')) {
            $datas->where('nama', 'like', '%' . request()->input('query') . '%');
        }
        $data = [
            'supplyer' => $datas->orderBy('id', 'desc')->get(),
        ];
        return view('supplyer.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $supplyer = new Supplyer();
        $supplyer->nama = $request->nama;
        $supplyer->save();

        return redirect()->back()->with('success', 'Supplyer Berhasil Ditambahkan.');
    }

    public function edit($id)
    {
        return response()->json([
            'success' => true,
            'data' => Supplyer::find($id),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nama' => 'required|string|max:255',
        ]);

        $supplyer = Supplyer::find($request->id);
        $supplyer->nama = $request->nama;
        $supplyer->save();

        return redirect()->back()->with('success', 'Supplyer Berhasil Diupdate.');
    }
    public function destroy($id)
    {
        $supplyer = Supplyer::find($id);
        $supplyer->delete();
        return redirect()->back()->with('success', 'Supplyer Dihapus.');
    }
}

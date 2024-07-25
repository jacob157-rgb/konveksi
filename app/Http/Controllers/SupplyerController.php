<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kain;
use App\Models\Models;
use App\Models\Supplyer;
use App\Models\Warna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $kain = Kain::all();
        $model = Models::all();
        $warna = Warna::all();
        $supplyer = Supplyer::all();
        return view('supplyer.indexnew', compact('kain', 'model', 'warna', 'supplyer'));
    }

    public function detail(Request $request, $id)
    {
        $barang = DB::table('barang')
            ->join('supplyer', 'supplyer.id', '=', 'barang.supplyer_id')
            ->join('kain', 'barang.kain_id', '=', 'kain.id')
            ->join('model', 'barang.model_id', '=', 'model.id')
            ->join('warna', 'barang.warna_id', '=', 'warna.id')
            ->select('barang.*', 'kain.nama as kain_nama', 'model.nama as model_nama', 'warna.nama as warna_nama')
            ->where('barang.supplyer_id', '=', $id)
            ->get();

        return view('supplyer.detail', compact('barang'));
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

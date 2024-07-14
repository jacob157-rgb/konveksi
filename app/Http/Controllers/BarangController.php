<?php

namespace App\Http\Controllers;

use App\Models\Kain;
use App\Models\Jahit;
use App\Models\Warna;
use App\Models\Barang;
use App\Models\Models;
use App\Models\Cutting;
use App\Models\Supplyer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BarangController extends Controller
{
    public function index()
    {
        $data = [
            'barang' => Barang::orderBy('id', 'desc')->get(),
        ];
        return view('barang.index', $data);
    }
    public function create()
    {
        $data = [
            'kain' => Kain::all(),
            'model' => Models::all(),
            'warna' => Warna::all(),
            'supplyer' => Supplyer::all(),
        ];
        return view('barang.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "supplyer_id" => 'required',
            "kain_id" => 'required',
            "model_id" => 'required',
            "warna_id" => 'required',
            "jumlah_mentah" => 'required',
            "satuan" => 'required',
            "harga" => 'required',
            "tanggal_datang" => 'required',
            "tanggal_jadi" =>  'required'
        ]);

        Barang::create([
            "supplyer_id" => $request->supplyer_id,
            "kain_id" => $request->kain_id,
            "model_id" => $request->model_id,
            "warna_id" => $request->warna_id,
            "jumlah_mentah" => $request->jumlah_mentah,
            "jumlah_cutting" => 0,
            "jumlah_jahit" => 0,
            "satuan" => $request->satuan,
            "harga" => $request->harga,
            "tanggal_datang" => $request->tanggal_datang,
            "tanggal_jadi" =>  $request->tanggal_jadi
        ]);

        return redirect('/barang')->with('success', 'Barang created successfully.');
    }

    public function edit($id)
    {
        $data = [
            'barang' => Barang::findOrFail($id),
            'kain' => Kain::all(),
            'model' => Models::all(),
            'warna' => Warna::all(),
            'supplyer' => Supplyer::all(),
        ];
        return view('barang.edit', $data);
    }
    public function show($id)
    {
        $data = [
            'barang' => Barang::findOrFail($id),
            'kain' => Kain::all(),
            'model' => Models::all(),
            'warna' => Warna::all(),
            'supplyer' => Supplyer::all(),
            'jahit' => Jahit::orderBy('id', 'desc')->where('barang_id', $id)->get(),
            'cutting' => Cutting::orderBy('id', 'desc')->where('barang_id', $id)->get(),
        ];
        return view('barang.show', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "supplyer_id" => 'required',
            "kain_id" => 'required',
            "model_id" => 'required',
            "warna_id" => 'required',
            "jumlah_mentah" => 'required',
            "satuan" => 'required',
            "harga" => 'required',
            "tanggal_datang" => 'required',
            "tanggal_jadi" =>  'required'
        ]);

        Barang::findOrFail($id)->update([
            "supplyer_id" => $request->supplyer_id,
            "kain_id" => $request->kain_id,
            "model_id" => $request->model_id,
            "warna_id" => $request->warna_id,
            "jumlah_mentah" => $request->jumlah_mentah,
            "jumlah_cutting" => 0,
            "jumlah_jahit" => 0,
            "satuan" => $request->satuan,
            "harga" => $request->harga,
            "tanggal_datang" => $request->tanggal_datang,
            "tanggal_jadi" =>  $request->tanggal_jadi
        ]);

        return redirect('/barang')->with('success', 'Barang updated successfully');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();
        return redirect()->back()->with('success', 'Barang delete successfully.');
    }
}

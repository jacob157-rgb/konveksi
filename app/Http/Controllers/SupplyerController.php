<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangJadi;
use App\Models\BarangMentah;
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
        $kain = Kain::all();
        $model = Models::all();
        $warna = Warna::all();
        $supplyer = Supplyer::orderBy('id', 'desc')->get();
        return view('pages.supplyer.index', compact('kain', 'model', 'warna', 'supplyer'));
    }

    public function detail(Request $request, $id)
    {
        $barangJadi = BarangJadi::where('supplyer_id', $id)->latest();

        if ($request->query('date')) {
            $tanggal = $request->query('date');
            $barangJadi->whereDate('tanggal_kirim', $tanggal);
        }

        $data = [
            'supplayer' => Supplyer::find($id),
            'barangMentah' => BarangMentah::where('supplyer_id', $id)->paginate(10),
            'barangJadi' => $barangJadi->get(),
        ];
        return view('pages.supplyer.detail', $data);
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

<?php

namespace App\Http\Controllers;

use App\Models\Kain;
use App\Models\Warna;
use App\Models\Barang;
use App\Models\Models;
use App\Models\Supplyer;
use App\Models\BarangJadi;
use App\Models\BarangMentah;
use Illuminate\Http\Request;
use App\Models\ModelBarangJadi;
use App\Models\ReturnBarang;
use App\Models\Selisih;
use Illuminate\Support\Collection;
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
        $barangMentah = BarangMentah::with(['kainBarangMentah.warnaKain'])
            ->where('supplyer_id', $id)
            ->latest();

        $groupedBarangMentah = $barangMentah->get()->groupBy('unique_id');

        $data = [
            'supplayer' => Supplyer::find($id),
            'tanggal' => $request->query('date'),
            'barangMentah' => $groupedBarangMentah,
        ];
        // dd($data);

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

    public function delete($id)
    {
        $supplyer = Supplyer::find($id);
        $supplyer->delete();
        return redirect()->back()->with('success', 'Supplyer Dihapus.');
    }


    // barang data

    public function addBarangDatang($unique)
    {
        $barangMentah = BarangMentah::with(['kainBarangMentah.warnaKain'])
            ->where('unique_id', $unique)
            ->latest();
        $data = [
            'barangMentahGet' => $barangMentah->get()->groupBy('unique_id'),
            'barangMentahFirst' => $barangMentah->first(),
            'kain' => Kain::all()
        ];
        $data['supplayer'] = Supplyer::find($data['barangMentahFirst']['supplyer_id']);
        return view('pages.supplyer.addBarangMentah', $data);
    }

    public function editBarangDatang($unique, $id)
    {
        $barangMentah = BarangMentah::with(['kainBarangMentah.warnaKain'])
            ->where('unique_id', $unique)
            ->latest();
        $data = [
            'barangMentahGet' => $barangMentah->get()->groupBy('unique_id'),
            'barangMentahFirst' => $barangMentah->where('id', $id)->first(),
            'kain' => Kain::all()
        ];
        $data['supplayer'] = Supplyer::find($data['barangMentahFirst']['supplyer_id']);
        // dd($data);
        return view('pages.supplyer.editBarangMentah', $data);
    }
    public function editBarangKirim($unique, $id)
    {
        $barangMentah = BarangJadi::with(['modelBarangJadi.warnaModel'])
            ->where('unique_id', $unique)
            ->latest();
        $data = [
            'barangKirimGet' => $barangMentah->get()->groupBy('unique_id'),
            'barangKirimFirst' => $barangMentah->where('id', $id)->first(),
            'model' => Models::all()
        ];
        $data['supplayer'] = Supplyer::find($data['barangKirimFirst']['supplyer_id']);
        // dd($data);
        return view('pages.supplyer.editBarangKirim', $data);
    }

    // cetak
    public function cetakPdf($unique)
    {
        $barangMentah = BarangMentah::with(['kainBarangMentah.warnaKain'])
            ->where('unique_id', $unique)
            ->latest();
        $barangJadi = BarangJadi::with(['modelBarangJadi.warnaModel'])
            ->where('unique_id', $unique)
            ->latest();
        $data = [
            'barangMentahGet' => $barangMentah->get()->groupBy('unique_id'),
            'barangMentahFirst' => $barangMentah->first(),
            'barangKirimGet' => $barangJadi->get()->groupBy('unique_id'),
            'barangKirimFirst' => $barangJadi->first(),
            'url' => env('APP_URL'),
            'selisih' => Selisih::where('unique_id', $unique)->get(),
            'returnBarang' => ReturnBarang::where('unique_id', $unique)->get(),
        ];
        $data['supplayer'] = Supplyer::find($data['barangMentahFirst']['supplyer_id']);
        return view('pages.supplyer.report', $data);
    }

    public function share(Request $request) {
        if(!$request->query('supplyer') || !$request->query('id_barang')) {
            return abort(404);
        }
        $unique = $request->query('id_barang');

        $barangMentah = BarangMentah::with(['kainBarangMentah.warnaKain'])
            ->where('unique_id', $unique)
            ->latest();
        $barangJadi = BarangJadi::with(['modelBarangJadi.warnaModel'])
            ->where('unique_id', $unique)
            ->latest();
        $data = [
            'barangMentahGet' => $barangMentah->get()->groupBy('unique_id'),
            'barangMentahFirst' => $barangMentah->first(),
            'barangKirimGet' => $barangJadi->get()->groupBy('unique_id'),
            'barangKirimFirst' => $barangJadi->first(),
            'url' => env('APP_URL'),
            'selisih' => Selisih::where('unique_id', $unique)->get(),
            'returnBarang' => ReturnBarang::where('unique_id', $unique)->get(),
        ];
        $data['supplayer'] = Supplyer::find($data['barangMentahFirst']['supplyer_id']);
        return view('pages.supplyer.report', $data);

    }
}

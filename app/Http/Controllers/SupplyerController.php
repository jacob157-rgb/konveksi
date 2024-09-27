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

    // public function detail(Request $request, $id)
    // {
    //     $barangJadi = BarangJadi::where('supplyer_id', $id)->latest();

    //     $barangMentah = BarangMentah::with(['kainBarangMentah.warnaKain'])
    //     ->where('supplyer_id', $id)
    //     ->latest();


    //     $totalsBarangJadi = BarangJadi::select('unique_id', DB::raw('SUM(warna_model.total) as total_sum'))->join('model_barang_jadi', 'barang_jadi.id', '=', 'model_barang_jadi.barang_jadi_id')->join('warna_model', 'model_barang_jadi.id', '=', 'warna_model.model_barang_jadi_id')->groupBy('unique_id')->get();
    //     $totalsBarangMentah = BarangMentah::select('unique_id', DB::raw('SUM(warna_kain.total) as total_sum'))->join('kain_barang_mentah', 'barang_mentah.id', '=', 'kain_barang_mentah.barang_mentah_id')->join('warna_kain', 'kain_barang_mentah.id', '=', 'warna_kain.kain_mentah_id')->groupBy('unique_id')->get();

    //     $mergedTotals = new Collection();

    //     foreach ($totalsBarangMentah as $mentah) {
    //         $jadi = $totalsBarangJadi->firstWhere('unique_id', $mentah->unique_id);

    //         // barang jadi - barnag mentah
    //         $selisih = $jadi ? $jadi->total_sum -  $mentah->total_sum : $mentah->total_sum;

    //         $mergedTotals->push([
    //             'unique_id' => $mentah->unique_id,
    //             'total_harga_masuk' => $mentah->total_sum,
    //             'total_harga_dikembalikan' => $jadi ? $jadi->total_sum : 0,
    //             'total_selisih' => $selisih,
    //         ]);
    //     }

    //     foreach ($totalsBarangJadi as $jadi) {
    //         if (!$totalsBarangMentah->firstWhere('unique_id', $jadi->unique_id)) {
    //             $mergedTotals->push([
    //                 'unique_id' => $jadi->unique_id,
    //                 'total_harga_masuk' => 0,
    //                 'total_harga_dikembalikan' => $jadi->total_sum,
    //                 'total_selisih' => -$jadi->total_sum,
    //             ]);
    //         }
    //     }

    //     // dd($mergedTotals);
    //     // dd($totalsBarangMentah, $totalsBarangJadi);

    //     if ($request->query('date')) {
    //         $tanggal = $request->query('date');
    //         $barangJadi->whereDate('tanggal_kirim', $tanggal);
    //         $barangMentah->whereDate('tanggal_datang', $tanggal);
    //     }

    //     $data = [
    //         'supplayer' => Supplyer::find($id),
    //         'barangMentah' => $barangMentah->get(),
    //         'barangJadi' => $barangJadi->get(),
    //         'modelBarangJadi' => ModelBarangJadi::all(),
    //         'warna' => Warna::all(),
    //         'model' => Models::all(),
    //         'mergedTotals' => $mergedTotals,
    //         'kain' => Kain::orderBy('id', 'desc')->get(),
    //     ];
    //     // return response()->json($data);
    //     // dd($data);
    //     return view('pages.supplyer.detail', $data);
    // }


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

    public function destroy($id)
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
}

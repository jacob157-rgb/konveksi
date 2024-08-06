<?php

namespace App\Http\Controllers;

use App\Models\Bon;
use App\Models\Barang;
use App\Models\Cutting;
use App\Models\Karyawan;
use App\Models\JahitAmbil;
use App\Models\BarangMentah;
use App\Models\CuttingAmbil;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawanJahit = Karyawan::where('jenis_karyawan', '=', 'jahit')->get();
        $karyawanCutting = Karyawan::where('jenis_karyawan', '=', 'cutting')->get();

        return view('pages.karyawan.index', compact('karyawanJahit', 'karyawanCutting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_karyawan' => 'required|in:cutting,jahit',
            'nama' => 'required|string|max:255',
            'no' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        Karyawan::create($request->all());

        return redirect('/karyawan')->with('success', 'Karyawan Berhasil Ditambahkan.');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return response()->json(['data' => $karyawan]);
    }
    public function editBon($id)
    {
        $bon = Bon::findOrFail($id);
        return response()->json(['data' => $bon]);
    }
    public function detail(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $jahitAmbil = collect();
        $cuttingAmbil = collect();

        if ($karyawan->jenis_karyawan == 'cutting') {
            $cuttingAmbil = CuttingAmbil::orderBy('id', 'desc')->where('id_karyawan', $id);

            if ($request->query('date')) {
                $tanggal = $request->query('date');
                $cuttingAmbil->whereDate('tanggal_ambil', $tanggal);
            }

            $cuttingAmbil = $cuttingAmbil->latest()->get();
        } else {
            $jahitAmbil = JahitAmbil::orderBy('id', 'desc')->where('id_karyawan', $id);

            if ($request->query('date')) {
                $tanggal = $request->query('date');
                $jahitAmbil->whereDate('tanggal_ambil', $tanggal);
            }

            $jahitAmbil = $jahitAmbil->latest()->get();
        }

        $data = [
            'karyawan' => $karyawan,
            'cuttingAmbil' => $cuttingAmbil,
            'jahitAmbil' => $jahitAmbil,
        ];

        // dd($data);
        return view('karyawan.show', $data);
    }

    public function print($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $bon = Bon::where('karyawan_id', $id)->get();

        $belumLunasBon = $bon->where('status', 'belumlunas');
        $lunasBon = $bon->where('status', 'lunas');

        $totalBelumLunas = $belumLunasBon->sum('nominal');
        $totalLunas = $lunasBon->sum('nominal');

        $data = [
            'karyawan' => $karyawan,
            'bon' => $bon,
            'totalBelumLunas' => $totalBelumLunas,
            'totalLunas' => $totalLunas,
        ];
        return view('karyawan.print', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:karyawan,id',
            'nama' => 'required|string|max:255',
            'jenis_karyawan' => 'required|in:cutting,jahit',
            'no' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        $karyawan = Karyawan::findOrFail($request->id);
        $karyawan->update($request->all());

        return redirect()->back()->with('success', 'Karyawan Berhasil Diupdate');
    }

    //cutting
    public function getCutting($id)
    {
        $karyawan = Karyawan::find($id);
        $cutting = CuttingAmbil::where('karyawan_id', $id)->get();
        $data = [
            'karyawan' => $karyawan,
            'cutting' => $cutting,
            'barang' => BarangMentah::orderBy('id', 'desc')->get(),
        ];

        // dd($data);
        return view('karyawan.cutting.index', $data);
    }

    public function updateBon(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:karyawan,id',
            'nominal' => 'required|string|max:255',
            'status' => 'required|in:lunas,belumlunas',
        ]);

        $karyawan = Bon::findOrFail($request->id);
        $karyawan->update($request->all());

        return redirect()->back()->with('success', 'BON Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);
        $karyawan->delete();
        return redirect()->back()->with('success', 'Karyawan Dihapus.');
    }
}

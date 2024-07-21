<?php

namespace App\Http\Controllers;

use App\Models\Bon;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $datas = Karyawan::latest();
        if (request()->input('query')) {
            $datas->where('nama', 'like', '%' . request()->input('query') . '%')
            ->orWhere('jenis_karyawan', 'like', '%' . request()->input('query') . '%')
            ->orWhere('alamat', 'like', '%' . request()->input('query') . '%')
            ->orWhere('no', 'like', '%' . request()->input('query') . '%');
        }
        $data = [
            'karyawan' => $datas->orderBy('id', 'desc')->get(),
        ];
        return view('karyawan.index', $data);
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
    public function show($id)
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

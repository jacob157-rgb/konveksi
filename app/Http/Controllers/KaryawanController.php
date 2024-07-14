<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $data = [
            'karyawan' => Karyawan::orderBy('id', 'desc')->get(),
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

        return redirect('/karyawan')->with('success', 'Karyawan created successfully.');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return response()->json(['data' => $karyawan]);
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

        return redirect()->back()->with('success', 'Karyawan updated successfully');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);
        $karyawan->delete();
        return redirect()->back()->with('success', 'Karyawan delete successfully.');
    }
}

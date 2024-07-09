<?php

namespace App\Http\Controllers;

use App\Models\Warna;
use Illuminate\Http\Request;

class WarnaController extends Controller
{
    public function index()
    {
        $data = [
            'warna' => Warna::orderBy('id', 'desc')->get(),
        ];
        return view('warna.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $warna = new Warna();
        $warna->nama = $request->nama;
        $warna->save();

        return redirect()->back()->with('success', 'warna created successfully.');
    }

    public function edit($id)
    {
        return response()->json([
            'success' => true,
            'data' => Warna::find($id),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nama' => 'required|string|max:255',
        ]);

        $warna = Warna::find($request->id);
        $warna->nama = $request->nama;
        $warna->save();

        return redirect()->back()->with('success', 'warna updated successfully.');
    }
    public function destroy($id)
    {
        $warna = Warna::find($id);
        $warna->delete();
        return redirect()->back()->with('success', 'warna delete successfully.');
    }
}

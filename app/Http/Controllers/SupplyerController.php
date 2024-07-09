<?php

namespace App\Http\Controllers;

use App\Models\Supplyer;
use Illuminate\Http\Request;

class SupplyerController extends Controller
{
    public function index()
    {
        $data = [
            'supplyer' => Supplyer::orderBy('id', 'desc')->get(),
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

        return redirect()->back()->with('success', 'supplyer created successfully.');
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

        return redirect()->back()->with('success', 'supplyer updated successfully.');
    }
    public function destroy($id)
    {
        $supplyer = Supplyer::find($id);
        $supplyer->delete();
        return redirect()->back()->with('success', 'supplyer delete successfully.');
    }
}

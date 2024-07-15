<?php

namespace App\Http\Controllers;

use App\Models\Models;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function index()
    {
        $data = [
            'model' => Models::orderBy('id', 'desc')->get(),
        ];
        return view('model.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $model = new Models();
        $model->nama = $request->nama;
        $model->save();

        return redirect()->back()->with('success', 'Model Berhasil Ditambahkan.');
    }

    public function edit($id)
    {
        return response()->json([
            'success' => true,
            'data' => Models::find($id),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nama' => 'required|string|max:255',
        ]);

        $model = Models::find($request->id);
        $model->nama = $request->nama;
        $model->save();

        return redirect()->back()->with('success', 'Model Berhasil Diupdate.');
    }
    public function destroy($id)
    {
        $model = Models::find($id);
        $model->delete();
        return redirect()->back()->with('success', 'Model Dihapus.');
    }
}

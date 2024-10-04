<?php

namespace App\Http\Controllers;

use App\Models\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModelController extends Controller
{
    public function index()
    {
        $model = Models::orderBy('id', 'desc')->get();
        return view('pages.model.index', compact('model'));
    }

    public function add()
    {
        return view('pages.model.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $model = new Models();
        $model->nama = $request->nama;
        $model->keterangan = $request->keterangan;
        $model->save();

        return redirect('/model')->with('success', 'Model Berhasil Ditambahkan.');
    }

    public function edit($id)
    {
        $edit = Models::find($id);
        return view('pages.model.edit', compact('edit'));
    }

    public function detail($id)
    {
        $detail = Models::find($id);
        return view('pages.model.detail', compact('detail'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $model = Models::find($id);
        $model->nama = $request->nama;
        $model->keterangan = $request->keterangan;
        $model->save();

        return redirect('/model')->with('success', 'Model Berhasil Diupdate.');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('uploads', 'public');
            return response()->json(['success' => true, 'url' => Storage::url($path)]);
        }
        return response()->json(['success' => false]);
    }


    public function destroy($id)
    {
        $model = Models::find($id);
        $model->delete();
        return redirect()->back()->with('success', 'Model Dihapus.');
    }
}

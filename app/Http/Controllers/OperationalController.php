<?php

namespace App\Http\Controllers;

use App\Models\Operational;
use Illuminate\Http\Request;

class OperationalController extends Controller
{
    public function index(Request $request)
    {
        $datas = Operational::latest();
        if (request()->input('start_date') && request()->input('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $datas->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate);
        }
        $data = [
            'operational' => $datas->orderBy('id', 'desc')->get(),
        ];
        return view('pages.operational.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'saldo_awal' => 'required',
            'keterangan' => 'required',
        ]);

        Operational::create([
            'saldo_awal' => str_replace('.', '', $request->saldo_awal),
            'sisa_saldo' => str_replace('.', '', $request->saldo_awal),
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/operational')->with('success', 'Catatan operational berhasil disimpan');
    }
    public function edit($id)
    {
        $operational = Operational::find($id);

        return response()->json([
            'success' => true,
            'data' => $operational,
        ]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'saldo_awal' => 'required',
            'keterangan' => 'required',
        ]);

        Operational::find($request->id)->update([
            'saldo_awal' => str_replace('.', '', $request->saldo_awal),
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/operational')->with('success', 'Catatan operational berhasil diupdate');
    }
    public function destroy($id)
    {
        $operational = Operational::find($id);
        $operational->delete();
        return redirect('/operational')->with('success', 'Catatan operational berhasil dihapus');
    }
}

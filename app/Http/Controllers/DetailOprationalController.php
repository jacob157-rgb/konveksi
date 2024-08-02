<?php

namespace App\Http\Controllers;

use App\Models\DetailOperational;
use App\Models\Operational;
use Illuminate\Http\Request;

class DetailOprationalController extends Controller
{
    public function index(Request $request, $id)
    {
        $operational = Operational::find($id);
        $datas = DetailOperational::latest();
        if (request()->input('start_date') && request()->input('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $datas->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate);
        }
        $data = [
            'pemakaian' => $datas
                ->orderBy('id', 'desc')
                ->where('operational_id', $operational?->id)
                ->get(),
            'operational' => $operational,
        ];
        return view('pages.operational.detail', $data);
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'saldo' => 'required',
            'keterangan' => 'required',
        ]);

        $operational = Operational::find($id);

        if ($operational->sisa_saldo < $request->saldo) {
            return redirect("/operational/pemakaian/{$id}")->with('error', 'Sisa saldo tidak mencukupi');
        }
        DetailOperational::create([
            'operational_id' => $operational->id,
            'saldo' => str_replace('.', '', $request->saldo),
            'keterangan' => $request->keterangan,
        ]);

        $kalkulasi = str_replace('.', '', $operational->sisa_saldo) - str_replace('.', '', $request->saldo);
        $operational->update([
            'sisa_saldo' => $kalkulasi,
        ]);
        return redirect("/operational/pemakaian/{$id}")->with('success', 'Catatan pemakaian berhasil disimpan');
    }

    public function edit($id)
    {
        $pemakaian = DetailOperational::find($id);
        return response()->json([
            'success' => true,
            'data' => $pemakaian,
        ]);
    }
    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'id' => 'required',
            'saldo' => 'required',
            'keterangan' => 'required',
        ]);

        // Find the relevant models
        $detailOperational = DetailOperational::find($request->id);
        $operational = Operational::find($detailOperational->operational_id);

        $saldoOld = (int) str_replace('.', '', $detailOperational->saldo);
        $saldoNew = (int) str_replace('.', '', $request->saldo);

        if ($saldoOld < $saldoNew) {
            // penambahan
            $kalkulasi = $saldoNew - $saldoOld;
            if ($operational->sisa_saldo < $kalkulasi) {
                return redirect("/operational/pemakaian/{$operational->id}")->with('error', 'Sisa saldo tidak mencukupi');
            } else {
                $sisaSaldoNew = $operational->sisa_saldo - $kalkulasi;
                $operational->update([
                    'sisa_saldo' => $sisaSaldoNew,
                ]);
                $detailOperational->update([
                    'saldo' => $saldoNew,
                    'keterangan' => $request->keterangan,
                ]);
                return redirect()->back()->with('success', 'Catatan Pemakaian berhasil diupdate');
            }
        } elseif ($saldoOld > $saldoNew) {
            // pengurangan
            $kalkulasi = $saldoOld - $saldoNew;
            $sisaSaldoNew = (int) str_replace('.', '', $operational->sisa_saldo) + $kalkulasi;
            $operational->update([
                'sisa_saldo' => $sisaSaldoNew,
            ]);
            $detailOperational->update([
                'saldo' => $saldoNew,
                'keterangan' => $request->keterangan,
            ]);
            return redirect()->back()->with('success', 'Catatan Pemakaian berhasil diupdate');
        }
    }

    public function destroy($id)
    {
        $detailOperational = DetailOperational::find($id);
        $operational = Operational::find($detailOperational->operational_id);
        $operational->update([
            'sisa_saldo' => $detailOperational->saldo += $operational->sisa_saldo
        ]);
        $detailOperational->delete();
        return redirect()->back()->with('success', 'Catatan pemakaian berhasil dihapus');
    }
}

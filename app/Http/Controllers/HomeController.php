<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangJadi;
use App\Models\BarangMentah;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'barang_sedang_proses' => [
                'data' => BarangMentah::get(),
                'count' => BarangMentah::count(),
            ],
            'barang_sudah_jadi' => [
                'data' => BarangJadi::get(),
                'count' => BarangJadi::count(),
            ],
            'cutting' => Karyawan::where('jenis_karyawan', 'cutting')->count(),
            'jahit' => Karyawan::where('jenis_karyawan', 'jahit')->count(),
        ];
        return view('home.index', $data);
    }
    public function getProfil()
    {
        $data = [
            'users' => User::find(auth()->user()->id),
        ];
        return view('pages.profil.index', $data);
    }
    public function postProfil(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string',
            'password_old' => 'required|string',
            'password_new' => 'required|string',
        ]);
        $user = Auth::user();
        if (!Hash::check($request->password_old, $user->password)) {
            return redirect()->back()->with('error', 'Password lama tidak sesuai.');
        }
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->password = Hash::make($request->password_new);
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}

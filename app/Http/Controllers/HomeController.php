<?php

namespace App\Http\Controllers;

use App\Models\BarangJadi;
use App\Models\BarangMentah;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

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
        // dd($data);
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
        Validator::make($request->all(), [
            'nama' => ['required', 'string'],
            'username' => ['required', 'string'],
            'password_old' => ['required', 'string'],
            'password' => ['required', 'confirmed', 'string']
        ]);

        if (Hash::check($request->password_old, auth()->user()->password)) {
            User::whereId(auth()->user()->id)->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => Hash::make($request->password)
            ]);
            return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Password lama tidak sesuai.');
        }
    }
}

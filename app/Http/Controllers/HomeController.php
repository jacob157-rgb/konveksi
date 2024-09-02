<?php

namespace App\Http\Controllers;

use App\Models\BarangJadi;
use App\Models\BarangMentah;
use App\Models\Kain;
use App\Models\Karyawan;
use App\Models\Models;
use App\Models\Supplyer;
use App\Models\User;
use App\Models\Warna;
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
            'mentah' => BarangMentah::count(),
            'jadi' => BarangJadi::count(),
            'cutting' => Karyawan::where('jenis_karyawan', 'cutting')->count(),
            'jahit' => Karyawan::where('jenis_karyawan', 'jahit')->count(),
            'kain' => Kain::count(),
            'model' => Models::count(),
            'warna' => Warna::count(),
            'supplyer' => Supplyer::count(),
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

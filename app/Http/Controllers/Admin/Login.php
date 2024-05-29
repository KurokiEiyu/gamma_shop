<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminLogin;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->get('id_admin'))
        {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function auth(AdminLogin $request)
    {
        $nama_pengguna  = $request->nama_pengguna;
        $kata_sandi     = $request->kata_sandi;

        $record = Admin::where('nama_pengguna', $nama_pengguna);

        if ($record->exists())
        {
            if (Hash::check($kata_sandi, $record->first()->kata_sandi))
            {
                $request->session()->put('id_admin', $record->first()->id_admin);
                return redirect()->route('admin.dashboard');
            }
            else
            {
                return redirect()->back()->withErrors(['Kata Sandi tidak cocok.']);
            }
        }
        else
        {
            return redirect()->back()->withErrors(['Nama Pengguna tidak ditemukan.']);
        }
    }
}

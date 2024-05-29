<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PelapakRequest;
use App\Models\Pelapak;
use Illuminate\Support\Facades\Hash;

class LoginSeller extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->get('id_pelapak'))
        {
            return redirect()->route('shop.home');
        }

        return view('shop.auth.login_seller');
    }

    public function auth(PelapakRequest $request)
    {
        $nama_pengguna  = $request->nama_pengguna;
        $kata_sandi     = $request->kata_sandi;

        $record = Pelapak::where('nama_pengguna', $nama_pengguna);

        if ($record->exists())
        {
            if (Hash::check($kata_sandi, $record->first()->kata_sandi))
            {
                if ($request->session()->has('id_pembeli'))
                {
                    $request->session()->forget('id_pembeli');
                }

                $request->session()->put('id_pelapak', $record->first()->id_pelapak);
                return redirect()->route('shop.home');
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

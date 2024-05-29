<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Pembeli;
use App\Http\Requests\PembeliRequest;

class LoginCustomer extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->get('id_pembeli'))
        {
            return redirect()->route('shop.home');
        }

        return view('shop.auth.login_customer');
    }

    public function auth(PembeliRequest $request)
    {
        $nama_pengguna  = $request->nama_pengguna;
        $kata_sandi     = $request->kata_sandi;

        $record = Pembeli::where('nama_pengguna', $nama_pengguna);

        if ($record->exists())
        {
            if (Hash::check($kata_sandi, $record->first()->kata_sandi))
            {
                if ($request->session()->has('id_pelapak'))
                {
                    $request->session()->forget('id_pelapak');
                }
                
                $request->session()->put('id_pembeli', $record->first()->id_pembeli);
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

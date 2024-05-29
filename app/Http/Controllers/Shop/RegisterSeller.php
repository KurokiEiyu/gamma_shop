<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterSellerRequest;
use App\Models\Pelapak;
use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterSeller extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->get('id_pelapak'))
        {
            return redirect()->route('shop.home');
        }

        return view('shop.auth.register_seller');
    }

    public function register(RegisterSellerRequest $request)
    {
        if (! preg_match('/^[0-9]*$/', $request->telepon))
        {
            return redirect()->back()->withErrors(['Nomor Telepon harus berupa angka.']);
        }

        if ($request->kata_sandi !== $request->konfirmasi_kata_sandi)
        {
            return redirect()->back()->withErrors(['Konfirmasi Kata Sandi tidak sama.']);
        }

        $id_pelapak = Pelapak::insertGetId([
            'nama_toko'     => $request->nama_toko,
            'nama_pemilik'  => $request->nama_pemilik,
            'nama_pengguna' => $request->nama_pengguna,
            'email'         => $request->email,
            'telepon'       => $request->telepon,
            'alamat'        => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kata_sandi'    => Hash::make($request->kata_sandi)
        ]);

        Saldo::insert([
            'pelapak_id'    => $id_pelapak,
            'nominal'       => '0'
        ]);

        return redirect()->route('shop.seller.login');
    }
}

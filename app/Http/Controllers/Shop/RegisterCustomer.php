<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterCustomerRequest;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterCustomer extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->get('id_pelapak'))
        {
            return redirect()->route('shop.home');
        }

        return view('shop.auth.register_customer');
    }

    public function register(RegisterCustomerRequest $request)
    {
        if (! preg_match('/^[0-9]*$/', $request->telepon))
        {
            return redirect()->back()->withErrors(['Nomor Telepon harus berupa angka.']);
        }

        if ($request->kata_sandi !== $request->konfirmasi_kata_sandi)
        {
            return redirect()->back()->withErrors(['Konfirmasi Kata Sandi tidak sama.']);
        }

        Pembeli::insert([
            'nama_lengkap'  => $request->nama_lengkap,
            'nama_pengguna' => $request->nama_pengguna,
            'email'         => $request->email,
            'telepon'       => $request->telepon,
            'alamat'        => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kata_sandi'    => Hash::make($request->kata_sandi)
        ]);

        return redirect()->route('shop.customer.login');
    }
}

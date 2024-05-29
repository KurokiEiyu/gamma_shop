<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAccount extends Controller
{
    public function index(Request $request)
    {
        $id_admin   = $request->session()->get('id_admin');

        $data   = [
            'nama_admin'    => Admin::where('id_admin', $id_admin)->first()->nama_lengkap,
            'admins'        => Admin::get()
        ];

        return view('admin.account', $data);
    }

    public function add(Request $request)
    {
        $id_admin   = $request->session()->get('id_admin');

        $data   = [
            'nama_admin'    => Admin::where('id_admin', $id_admin)->first()->nama_lengkap
        ];

        return view('admin.account_add', $data);
    }

    public function add_process(AdminRequest $request)
    {
        if ($request->kata_sandi !== $request->konfirmasi_kata_sandi)
        {
            return redirect()->back()->withErrors(['Konfirmasi Kata Sandi tidak sama.']);
        }

        if (Admin::where('nama_pengguna', $request->nama_pengguna)->count() > 0)
        {
            return redirect()->back()->withErrors(['Nama Pengguna sudah ada.']);
        }

        Admin::insert([
            'nama_lengkap'  => $request->nama_lengkap,
            'nama_pengguna' => $request->nama_pengguna,
            'email'         => $request->email,
            'kata_sandi'    => Hash::make($request->kata_sandi)
        ]);

        return redirect()->route('admin.data.account');
    }

    public function edit(Request $request, $id)
    {
        $id_admin   = $request->session()->get('id_admin');

        $data   = [
            'nama_admin'    => Admin::where('id_admin', $id_admin)->first()->nama_lengkap,
            'account'       => Admin::where('id_admin', $id)->first()
        ];

        return view('admin.account_edit', $data);
    }

    public function edit_process(AdminRequest $request)
    {
        if ($request->kata_sandi !== $request->konfirmasi_kata_sandi)
        {
            return redirect()->back()->withErrors(['Konfirmasi Kata Sandi tidak sama.']);
        }

        Admin::Where('id_admin', $request->id_admin)->update([
            'nama_lengkap'  => $request->nama_lengkap,
            'nama_pengguna' => $request->nama_pengguna,
            'email'         => $request->email,
            'kata_sandi'    => Hash::make($request->kata_sandi)
        ]);

        return redirect()->route('admin.data.account');
    }

    public function delete_process(Request $request)
    {
        Admin::where('id_admin', $request->id_admin)->delete();

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Pembeli;

class Customer extends Controller
{
    public function index(Request $request)
    {
        $id_admin   = $request->session()->get('id_admin');

        $data = [
            'nama_admin'        => Admin::where('id_admin', $id_admin)->first()->nama_lengkap,
            'customers'         => Pembeli::get(),
            'jumlah_pembeli'    => Pembeli::count()
        ];

        return view('admin.customer', $data);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Pelapak;

class Seller extends Controller
{
    public function index(Request $request)
    {
        $id_admin   = $request->session()->get('id_admin');

        $data   = [
            'nama_admin'        => Admin::where('id_admin', $id_admin)->first()->nama_lengkap,
            'sellers'           => Pelapak::get(),
            'jumlah_pelapak'    => Pelapak::count()
        ];

        return view('admin.seller', $data);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Produk;


class Product extends Controller
{
    public function index(Request $request)
    {
        $id_admin   = $request->session()->get('id_admin');

        $data = [
            'nama_admin'        => Admin::where('id_admin', $id_admin)->first()->nama_lengkap,
            'products'          => Produk::join('pelapak', 'pelapak_id', 'pelapak.id_pelapak')->join('kategori', 'kategori_id', 'kategori.id_kategori')->get(),
            'jumlah_produk'     => Produk::count()
        ];

        return view('admin.product', $data);
    }
}

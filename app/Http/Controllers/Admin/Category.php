<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Kategori;

class Category extends Controller
{
    public function index(Request $request)
    {
        $id_admin = $request->session()->get('id_admin');

        $data   = [
            'nama_admin'        => Admin::where('id_admin', $id_admin)->first()->nama_lengkap,
            'categories'        => Kategori::get()
        ];

        return view('admin.category', $data);
    }

    public function add(Request $request)
    {
        $id_admin = $request->session()->get('id_admin');

        $data   = [
            'nama_admin'    => Admin::where('id_admin', $id_admin)->first()->nama_lengkap
        ];

        return view('admin.category_add', $data);
    }

    public function add_process(CategoryRequest $request)
    {
        $id_admin = $request->session()->get('id_admin');

        if (Kategori::where('nama_kategori', $request->nama_kategori)->count() > 0)
        {
            return redirect()->back()->withErrors(['Nama Kategori sudah ada']);
        }

        Kategori::insert([
            'admin_id'      => $id_admin,
            'nama_kategori'  => $request->nama_kategori
        ]);

        return redirect()->route('admin.data.category');
    }

    public function edit(Request $request, $id)
    {
        $id_admin = $request->session()->get('id_admin');

        $data   = [
            'nama_admin'    => Admin::where('id_admin', $id_admin)->first()->nama_lengkap,
            'category'      => Kategori::where('id_kategori', $id)->first()
        ];

        if (Kategori::where('id_kategori', $id)->count() === 0)
        {
            return redirect()->back();
        }

        return view('admin.category_edit', $data);
    }

    public function edit_process(CategoryRequest $request)
    {
        Kategori::where('id_kategori', $request->id_kategori)->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.data.category');
    }

    public function delete_process(Request $request)
    {
        Kategori::where('id_kategori', $request->id_kategori)->delete();

        return redirect()->route('admin.data.category');
    }
}

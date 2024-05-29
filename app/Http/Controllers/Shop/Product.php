<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukRequest;
use App\Http\Requests\ProdukEditRequest;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Support\Facades\File;

class Product extends Controller
{
    public function add()
    {
        $data = [
            'categories'    => Kategori::get()
        ];

        return view('shop.product_add', $data);
    }

    public function add_process(ProdukRequest $request)
    {
        $id_pelapak = $request->session()->get('id_pelapak');

        $id = Produk::insertGetId([
            'pelapak_id'    => $id_pelapak,
            'kategori_id'   => $request->kategori,
            'nama_produk'   => $request->nama_produk,
            'deskripsi'     => $request->deskripsi,
            'ukuran'        => $request->ukuran,
            'path_foto'     => 'foto_produk/',
            'harga'         => $request->harga,
            'stok'          => $request->stok
        ]);

        $image1_name = $id."_foto1.".$request->foto_1->extension();
        $request->foto_1->move(public_path('foto_produk'), $image1_name);

        if (isset($request->foto_2))
        {
            $image2_name = $id."_foto2.".$request->foto_1->extension();
            $request->foto_2->move(public_path('foto_produk'), $image2_name);
        }

        if (isset($request->foto_3))
        {
            $image3_name = $id."_foto3.".$request->foto_1->extension();
            $request->foto_3->move(public_path('foto_produk'), $image3_name);
        }
        
        return redirect()->route('shop.seller.mystore');
    }

    public function edit(Request $request, $id)
    {
        $data = [
            'categories'    => Kategori::get(),
            'product'       => Produk::where('id_produk', $id)->first()
        ];

        return view('shop.product_edit', $data);
    }
    
    public function edit_process(ProdukEditRequest $request)
    {
        $id = $request->id_produk;
        
        Produk::where('id_produk', $id)->update([
            'kategori_id'   => $request->kategori,
            'nama_produk'   => $request->nama_produk,
            'deskripsi'     => $request->deskripsi,
            'ukuran'        => $request->ukuran,
            'path_foto'     => 'foto_produk/',
            'harga'         => $request->harga,
            'stok'          => $request->stok
        ]);
        
        if (isset($request->foto_1))
        {
            $image1_name = $id."_foto1.".$request->foto_1->extension();
            
            if (file_exists(asset('foto_produk/'.$image1_name)))
            {
                if (! File::delete('foto_produk/'.$image1_name))
                {
                    return redirect()->back()->withErrors(['Gagal menghapus foto lama.']);
                }
            }
            
            $request->foto_1->move(public_path('foto_produk'), $image1_name);
        }

        if (isset($request->foto_2))
        {
            $image2_name = $id."_foto2.".$request->foto_2->extension();
            
            if (file_exists(asset('foto_produk/'.$image2_name)))
            {
                if (! File::delete('foto_produk/'.$image2_name))
                {
                    return redirect()->back()->withErrors([
                        'Gagal menghapus foto lama.'
                    ]);
                }
            }
            
            $request->foto_2->move(public_path('foto_produk'), $image2_name);
        }

        if (isset($request->foto_3))
        {
            $image3_name = $id."_foto3.".$request->foto_3->extension();
            
            if (file_exists(asset('foto_produk/'.$image3_name)))
            {
                if (! File::delete('foto_produk/'.$image3_name))
                {
                    return redirect()->back()->withErrors([
                        'Gagal menghapus foto lama.'
                    ]);
                }
            }
            
            $request->foto_3->move(public_path('foto_produk'), $image3_name);
        }
        
        return redirect()->route('shop.seller.mystore');
    }
    
    public function delete_process(Request $request)
    {
        $image1_name = $request->id_produk."_foto1.jpg";
        $image2_name = $request->id_produk."_foto2.jpg";
        $image3_name = $request->id_produk."_foto3.jpg";

        Produk::where('id_produk', $request->id_produk)->delete();
        File::delete('foto_produk/'.$image1_name);
        File::delete('foto_produk/'.$image2_name);
        File::delete('foto_produk/'.$image3_name);
        
        return redirect()->back();
    }
}

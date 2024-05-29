<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorit;
use App\Models\Keranjang;
use App\Models\Rekening;

class Cart extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'carts'     => Keranjang::join('produk', 'produk_id', 'produk.id_produk')->join('pelapak', 'id_pelapak', 'produk.pelapak_id')->where('pembeli_id', $request->session()->get('id_pembeli'))->get(),
            'contacts'  => Keranjang::select('nama_toko', 'telepon')->join('produk', 'produk_id', 'produk.id_produk')->join('pelapak', 'id_pelapak', 'produk.pelapak_id')->where('pembeli_id', $request->session()->get('id_pembeli'))->groupBy('pelapak.id_pelapak')->get(),
            'favorites' => Favorit::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $request->session()->get('id_pembeli'))->get(),
            'rekenings' => Rekening::get()
        ];

        return view('shop.cart', $data);
    }

    public function add(Request $request)
    {
        $pembeli_id = $request->session()->get('id_pembeli');
        $produk_id  = $request->product_id;
        $qty        = $request->qty;
        $ukuran     = $request->size;

        if ($qty <= 0)
        {
            return response()->json([
                'status'    => 'failed'
            ]);
        }

        $record     = Keranjang::where('pembeli_id', $pembeli_id)->where('produk_id', $produk_id);

        if ($record->where('ukuran_terpilih', $ukuran)->exists())
        {
            $db_qty = $record->first()->qty;
            $record->update(['qty' => $db_qty + $qty]);
        }
        else
        {
            Keranjang::insert(
                [
                    'pembeli_id'        => $pembeli_id,
                    'produk_id'         => $produk_id,
                    'qty'               => $qty,
                    'ukuran_terpilih'   => $ukuran
                ]
            );
        }

        $carts = Keranjang::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $pembeli_id)->get();
        $carts_2 = [];

        foreach ($carts as $cart)
        {
            array_push($carts_2, $cart);
        }

        return response()->json([
            'status'        => 'success',
            'data'          => $carts_2,
            'total_cart'    => Keranjang::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $pembeli_id)->count()
        ]);
    }

    public function delete(Request $request)
    {
        $id_pembeli = $request->session()->get('id_pembeli');
        
        if (Keranjang::where('id_keranjang', $request->id_cart)->delete())
        {
            $carts = Keranjang::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $id_pembeli)->get();
            $carts_2 = [];

            foreach ($carts as $cart)
            {
                array_push($carts_2, $cart);
            }

            return response()->json([
                'status'        => 'success',
                'data'          => $carts_2,
                'total_cart'    => Keranjang::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $id_pembeli)->count()
            ]);
        }
        else
        {
            return response()->json([
                'status'    => 'failed'
            ]);
        }
    }
}

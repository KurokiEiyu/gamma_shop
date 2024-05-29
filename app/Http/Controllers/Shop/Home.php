<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Favorit;
use App\Models\Keranjang;
use App\Models\RiwayatPesanan;

class Home extends Controller
{
    public function index(Request $request)
    {
        $id_pembeli = $request->session()->get('id_pembeli');

        $data   = [
            'categories'    => Kategori::get(),
            'products'      => Produk::whereNotIn('stok', [0])->get(),
            'favorites'     => Favorit::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $id_pembeli)->get(),
            'carts'         => Keranjang::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $id_pembeli)->get(),
            'ratings'       => []
        ];
                    
        foreach ($data['products'] as $item)
        {
            $avg        = RiwayatPesanan::join('transaksi', 'id_transaksi', 'riwayat_pesanan.transaksi_id')
                            ->join('order_detail', 'id_order_detail', 'transaksi.order_detail_id')
                            ->join('order_item', 'order_item.order_detail_id', 'id_order_detail')
                            ->where('order_item.produk_id', $item->id_produk)
                            ->avg('bintang');
            
            array_push($data['ratings'], $avg);
        }
        
        return view('shop.home', $data);
    }
}

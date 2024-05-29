<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Favorit;
use App\Models\Keranjang;
use App\Models\RiwayatPesanan;

class ProductDetail extends Controller
{
    public function index(Request $request, $id)
    {
        $product    = Produk::where('id_produk', $id)->join('kategori', 'kategori_id', 'kategori.id_kategori')->first();

        if ($product === null) {
            return redirect()->route('shop.home');
        }

        $products   = Produk::where('kategori_id', $product->kategori_id)
                        ->whereNotIn('id_produk', [$id])
                        ->whereNotIn('stok', [0])
                        ->limit(8)
                        ->get();

        $favorites  = Favorit::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $request->session()->get('id_pembeli'))->get();
        $carts      = Keranjang::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $request->session()->get('id_pembeli'))->get();
        $reviews    = RiwayatPesanan::join('pembeli', 'id_pembeli', 'riwayat_pesanan.pembeli_id')
                        ->join('transaksi', 'id_transaksi', 'riwayat_pesanan.transaksi_id')
                        ->join('order_detail', 'id_order_detail', 'transaksi.order_detail_id')
                        ->join('order_item', 'order_item.order_detail_id', 'id_order_detail')
                        ->where('produk_id', $id)
                        ->whereNotNull('bintang')
                        ->whereNotNull('ulasan')
                        ->orderBy('id_riwayat_pesanan', 'desc')
                        ->limit(5)
                        ->get();
        
        $ratings    = [];
                    
        foreach ($products as $item)
        {
            $avg        = RiwayatPesanan::join('transaksi', 'id_transaksi', 'riwayat_pesanan.transaksi_id')
                            ->join('order_detail', 'id_order_detail', 'transaksi.order_detail_id')
                            ->join('order_item', 'order_item.order_detail_id', 'id_order_detail')
                            ->where('order_item.produk_id', $item->id_produk)
                            ->avg('bintang');
            
            array_push($ratings, $avg);
        }

        return view('shop.product_detail')->with(compact('product', 'products', 'favorites', 'carts', 'reviews', 'ratings'));
    }
}

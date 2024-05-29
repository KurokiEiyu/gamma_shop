<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorit;
use App\Models\Keranjang;
use App\Models\RiwayatPesanan;

class OrderDetail extends Controller
{
    public function index(Request $request, $id)
    {
        $id_pembeli = $request->session()->get('id_pembeli');

        $carts      = Keranjang::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $id_pembeli)->get();
        $favorites  = Favorit::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $id_pembeli)->get();
        $order      = RiwayatPesanan::join('transaksi', 'transaksi_id', 'transaksi.id_transaksi')
        ->join('order_detail', 'transaksi.order_detail_id', 'order_detail.id_order_detail')
        ->join('pembayaran', 'transaksi.pembayaran_id', 'pembayaran.id_pembayaran')
        ->join('order_item', 'order_detail.id_order_detail', 'order_item.order_detail_id')
        ->join('produk', 'order_item.produk_id', 'produk.id_produk')
        ->where('id_riwayat_pesanan', $id)->get();

        return view('shop.order_detail')->with(compact('carts', 'favorites', 'order'));
    }
}

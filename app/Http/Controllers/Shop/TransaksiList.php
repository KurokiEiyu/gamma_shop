<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Pelapak;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiList extends Controller
{
    public function index(Request $request)
    {
        $id_pelapak = $request->session()->get('id_pelapak');

        $data   = [
            'store_name'    => Pelapak::where('id_pelapak', $request->session()->get('id_pelapak'))->first()->nama_toko,
            'transactions'  => Transaksi::join('riwayat_pesanan', 'riwayat_pesanan.transaksi_id', 'id_transaksi')
                                ->join('pembayaran', 'id_pembayaran', 'transaksi.pembayaran_id')
                                ->join('order_detail', 'id_order_detail', 'transaksi.order_detail_id')
                                ->join('order_item', 'order_item.order_detail_id', 'id_order_detail')
                                ->join('produk', 'id_produk', 'order_item.produk_id')
                                ->where('produk.pelapak_id', $id_pelapak)
                                ->whereIn('order_item.status', ['dikemas', 'dikirim', 'penilaian', 'selesai'])
                                ->groupBy('id_transaksi')
                                ->orderBy('id_transaksi', 'desc')
                                ->get(),
            'products'      =>  Transaksi::join('order_detail', 'id_order_detail', 'transaksi.order_detail_id')
                                ->join('order_item', 'order_item.order_detail_id', 'id_order_detail')
                                ->join('produk', 'id_produk', 'order_item.produk_id')
                                ->whereIn('order_item.status', ['dikemas', 'dikirim', 'penilaian', 'selesai'])
                                ->where('produk.pelapak_id', $id_pelapak)
                                ->orderBy('id_transaksi', 'desc')
                                ->get()
        ];

        return view('shop.transaksi_list', $data);
    }

    public function print(Request $request, $id)
    {
        $id_pelapak = $request->session()->get('id_pelapak');

        $data   = [
            'store_name'    => Pelapak::where('id_pelapak', $request->session()->get('id_pelapak'))->first()->nama_toko,
            'transactions'  => Transaksi::join('riwayat_pesanan', 'riwayat_pesanan.transaksi_id', 'id_transaksi')
                                ->join('pembayaran', 'id_pembayaran', 'transaksi.pembayaran_id')
                                ->join('order_detail', 'id_order_detail', 'transaksi.order_detail_id')
                                ->join('order_item', 'order_item.order_detail_id', 'id_order_detail')
                                ->join('produk', 'id_produk', 'order_item.produk_id')
                                ->where('produk.pelapak_id', $id_pelapak)
                                ->where('id_transaksi', $id)
                                ->whereIn('order_item.status', ['dikemas', 'dikirim', 'penilaian', 'selesai'])
                                ->groupBy('id_transaksi')
                                ->orderBy('id_transaksi', 'desc')
                                ->get(),
            'products'      =>  Transaksi::join('order_detail', 'id_order_detail', 'transaksi.order_detail_id')
                                ->join('order_item', 'order_item.order_detail_id', 'id_order_detail')
                                ->join('produk', 'id_produk', 'order_item.produk_id')
                                ->whereIn('order_item.status', ['dikemas', 'dikirim', 'penilaian', 'selesai'])
                                ->where('produk.pelapak_id', $id_pelapak)
                                ->where('id_transaksi', $id)
                                ->orderBy('id_transaksi', 'desc')
                                ->get()
        ];

        return view('shop.transaksi_print', $data);
    }

    public function print_all(Request $request)
    {
        $id_pelapak = $request->session()->get('id_pelapak');

        $data   = [
            'store_name'    => Pelapak::where('id_pelapak', $request->session()->get('id_pelapak'))->first()->nama_toko,
            'transactions'  => Transaksi::join('riwayat_pesanan', 'riwayat_pesanan.transaksi_id', 'id_transaksi')
                                ->join('pembayaran', 'id_pembayaran', 'transaksi.pembayaran_id')
                                ->join('order_detail', 'id_order_detail', 'transaksi.order_detail_id')
                                ->join('order_item', 'order_item.order_detail_id', 'id_order_detail')
                                ->join('produk', 'id_produk', 'order_item.produk_id')
                                ->where('produk.pelapak_id', $id_pelapak)
                                ->whereIn('order_item.status', ['dikemas', 'dikirim', 'penilaian', 'selesai'])
                                ->groupBy('id_transaksi')
                                ->orderBy('id_transaksi', 'desc')
                                ->get(),
            'products'      =>  Transaksi::join('order_detail', 'id_order_detail', 'transaksi.order_detail_id')
                                ->join('order_item', 'order_item.order_detail_id', 'id_order_detail')
                                ->join('produk', 'id_produk', 'order_item.produk_id')
                                ->whereIn('order_item.status', ['dikemas', 'dikirim', 'penilaian', 'selesai'])
                                ->where('produk.pelapak_id', $id_pelapak)
                                ->orderBy('id_transaksi', 'desc')
                                ->get()
        ];

        return view('shop.transaksi_print_all', $data);
    }
}

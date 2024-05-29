<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\OrderItem as ModelOrderItem;
use App\Models\Favorit;
use App\Models\Keranjang;
use App\Models\RiwayatPesanan;
use Illuminate\Http\Request;

class OrderItem extends Controller
{
    public function update_status(Request $request)
    {
        ModelOrderItem::where('id_order_item', $request->id_order_item)->update(['status' => 'penilaian']);

        return redirect()->back();
    }

    public function review(Request $request, $id)
    {
        $id_pembeli = $request->session()->get('id_pembeli');

        $data   = [
            'favorites' => Favorit::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $id_pembeli)->get(),
            'carts'     => Keranjang::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $id_pembeli)->get(),
            'product'   => ModelOrderItem::join('produk', 'id_produk', 'order_item.produk_id')
                            ->join('order_detail', 'id_order_detail', 'order_item.order_detail_id')
                            ->join('transaksi', 'transaksi.order_detail_id', 'id_order_detail')
                            ->join('riwayat_pesanan', 'riwayat_pesanan.transaksi_id', 'id_transaksi')
                            ->where('id_order_item', $id)
                            ->first()
        ];

        if ($data['product']->status !== 'penilaian')
        {
            return redirect()->back();
        }

        return view('shop.review', $data);
    }

    public function review_process(Request $request)
    {
        RiwayatPesanan::where('id_riwayat_pesanan', $request->id_riwayat_pesanan)->update([
            'bintang'   => $request->bintang,
            'ulasan'    => $request->ulasan
        ]);

        ModelOrderItem::where('id_order_item', $request->id_order_item)->update([
            'status'    => 'selesai'
        ]);

        return redirect()->route('shop.customer.account');
    }
}

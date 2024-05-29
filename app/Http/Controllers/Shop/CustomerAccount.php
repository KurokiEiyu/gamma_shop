<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterCustomerRequest;
use Illuminate\Http\Request;
use App\Models\Favorit;
use App\Models\Keranjang;
use App\Models\OrderItem;
use App\Models\Pelapak;
use App\Models\Pembeli;
use App\Models\RiwayatPesanan;
use Illuminate\Support\Facades\Hash;

class CustomerAccount extends Controller
{
    public function index(Request $request)
    {
        $id_pembeli = $request->session()->get('id_pembeli');

        $carts          = Keranjang::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $id_pembeli)->get();
        $favorites      = Favorit::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $id_pembeli)->get();
        $customer_name  = Pembeli::select('nama_lengkap')->where('id_pembeli', $request->session()->get('id_pembeli'))->first()->nama_lengkap;

        $history_orders = RiwayatPesanan::where('pembeli_id', $id_pembeli)->orderBy('id_riwayat_pesanan', 'desc')->get();
        
        $items['unconfirm']     = OrderItem::join('order_detail', 'id_order_detail', 'order_item.order_detail_id')
                                    ->join('produk', 'id_produk', 'order_item.produk_id')
                                    ->join('transaksi', 'transaksi.order_detail_id', 'id_order_detail')
                                    ->join('riwayat_pesanan', 'riwayat_pesanan.transaksi_id', 'id_transaksi')
                                    ->where('order_detail.pembeli_id', $id_pembeli)
                                    ->where('status', 'menunggu konfirmasi')
                                    ->get();

        $items['packaged']      = OrderItem::join('order_detail', 'id_order_detail', 'order_item.order_detail_id')
                                    ->join('produk', 'id_produk', 'order_item.produk_id')
                                    ->join('transaksi', 'transaksi.order_detail_id', 'id_order_detail')
                                    ->join('riwayat_pesanan', 'riwayat_pesanan.transaksi_id', 'id_transaksi')
                                    ->where('order_detail.pembeli_id', $id_pembeli)
                                    ->where('status', 'dikemas')
                                    ->get();

        $items['shipping']      = OrderItem::join('order_detail', 'id_order_detail', 'order_item.order_detail_id')
                                    ->join('produk', 'id_produk', 'order_item.produk_id')
                                    ->join('transaksi', 'transaksi.order_detail_id', 'id_order_detail')
                                    ->join('riwayat_pesanan', 'riwayat_pesanan.transaksi_id', 'id_transaksi')
                                    ->where('order_detail.pembeli_id', $id_pembeli)
                                    ->where('status', 'dikirim')
                                    ->get();

        $items['rating']        = OrderItem::join('order_detail', 'id_order_detail', 'order_item.order_detail_id')
                                    ->join('produk', 'id_produk', 'order_item.produk_id')
                                    ->join('transaksi', 'transaksi.order_detail_id', 'id_order_detail')
                                    ->join('riwayat_pesanan', 'riwayat_pesanan.transaksi_id', 'id_transaksi')
                                    ->where('order_detail.pembeli_id', $id_pembeli)
                                    ->where('status', 'penilaian')
                                    ->get();

        $items['finish']        = OrderItem::join('order_detail', 'id_order_detail', 'order_item.order_detail_id')
                                    ->join('produk', 'id_produk', 'order_item.produk_id')
                                    ->join('transaksi', 'transaksi.order_detail_id', 'id_order_detail')
                                    ->join('riwayat_pesanan', 'riwayat_pesanan.transaksi_id', 'id_transaksi')
                                    ->where('order_detail.pembeli_id', $id_pembeli)
                                    ->where('status', 'selesai')
                                    ->get();

        return view('shop.myaccount')->with(compact('carts', 'favorites', 'customer_name', 'history_orders', 'items'));
    }

    public function edit(Request $request)
    {
        $data   = [
            'customer'  => Pembeli::where('id_pembeli', $request->session()->get('id_pembeli'))->first(),
            'carts'     => Keranjang::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $request->session()->get('id_pembeli'))->get(),
            'favorites' => Favorit::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $request->session()->get('id_pembeli'))->get()
        ];

        return view('shop.edit_profile', $data);
    }

    public function edit_process(RegisterCustomerRequest $request)
    {
        if (! preg_match('/^[0-9]*$/', $request->telepon))
        {
            return redirect()->back()->withErrors(['Nomor Telepon harus berupa angka.']);
        }

        if ($request->kata_sandi !== $request->konfirmasi_kata_sandi)
        {
            return redirect()->back()->withErrors(['Konfirmasi Kata Sandi tidak sama.']);
        }

        Pembeli::where('id_pembeli', $request->session()->get('id_pembeli'))->update([
            'nama_lengkap'  => $request->nama_lengkap,
            'nama_pengguna' => $request->nama_pengguna,
            'email'         => $request->email,
            'telepon'       => $request->telepon,
            'alamat'        => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kata_sandi'    => Hash::make($request->kata_sandi)
        ]);

        return redirect()->route('shop.customer.account');
    }
}

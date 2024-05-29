<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterSellerRequest;
use App\Models\OrderItem;
use App\Models\Pelapak;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\RiwayatPesanan;
use App\Models\Saldo;
use Illuminate\Support\Facades\Hash;

class Store extends Controller
{
    public function index(Request $request)
    {
        $id_pelapak = $request->session()->get('id_pelapak');

        $data = [
            'products'          => Produk::where('pelapak_id', $id_pelapak)->get(),
            'store_name'        => Pelapak::where('id_pelapak', $id_pelapak)->first()->nama_toko,
            'saldo'             => Saldo::where('pelapak_id', $id_pelapak)->first()->nominal,
            'terjual'           => OrderItem::join('produk', 'id_produk', 'order_item.produk_id')->join('pelapak', 'id_pelapak', 'produk.pelapak_id')->where('id_pelapak', $id_pelapak)->sum('qty'),
            'stok'              => Produk::where('pelapak_id', $id_pelapak)->sum('stok'),
            'pendapatan'        => 0
        ];

        foreach(OrderItem::join('produk', 'id_produk', 'order_item.produk_id')->where('pelapak_id', $id_pelapak)->get() as $item)
        {
            $data['pendapatan'] += ($item->harga - $item->fee_admin) * $item->qty;
        }
        
        return view('shop.mystore', $data);
    }

    public function order_list(Request $request)
    {
        $data   = [
            'order_list'    => OrderItem::join('produk', 'id_produk', 'order_item.produk_id')
                                ->join('order_detail', 'id_order_detail', 'order_item.order_detail_id')
                                ->where('produk.pelapak_id', $request->session()->get('id_pelapak'))
                                ->whereIn('status', ['menunggu konfirmasi', 'dikemas', 'dikirim'])
                                ->orderBy('id_order_item', 'desc')
                                ->get(),
            'store_name'    => Pelapak::where('id_pelapak', $request->session()->get('id_pelapak'))->first()->nama_toko
        ];

        return view('shop.order_list', $data);
    }

    public function update_order_status(Request $request)
    {
        if ($request->old_status === $request->status)
        {
            return redirect()->back();
        }

        OrderItem::where('id_order_item', $request->id_order_item)->update([
            'status'    => $request->status
        ]);

        return redirect()->back();
    }

    public function edit_store(Request $request)
    {
        $data   = [
            'store' =>  Pelapak::where('id_pelapak', $request->session()->get('id_pelapak'))->first()
        ];

        return view('shop.edit_store', $data);
    }

    public function edit_store_process(RegisterSellerRequest $request)
    {
        if (! preg_match('/^[0-9]*$/', $request->telepon))
        {
            return redirect()->back()->withErrors(['Nomor Telepon harus berupa angka.']);
        }

        if ($request->kata_sandi !== $request->konfirmasi_kata_sandi)
        {
            return redirect()->back()->withErrors(['Konfirmasi Kata Sandi tidak sama.']);
        }

        Pelapak::where('id_pelapak', $request->session()->get('id_pelapak'))->update([
            'nama_toko'     => $request->nama_toko,
            'nama_pemilik'  => $request->nama_pemilik,
            'nama_pengguna' => $request->nama_pengguna,
            'email'         => $request->email,
            'telepon'       => $request->telepon,
            'alamat'        => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kata_sandi'    => Hash::make($request->kata_sandi)
        ]);

        return redirect()->route('shop.seller.mystore');
    }

    public function report(Request $request)
    {
        $id_pelapak = $request->session()->get('id_pelapak');

        $data = [
            'products'          => Produk::where('pelapak_id', $id_pelapak)->get(),
            'store'             => Pelapak::where('id_pelapak', $id_pelapak)->first(),
            'saldo'             => Saldo::where('pelapak_id', $id_pelapak)->first()->nominal,
            'terjual'           => OrderItem::join('produk', 'id_produk', 'order_item.produk_id')->join('pelapak', 'id_pelapak', 'produk.pelapak_id')->where('id_pelapak', $id_pelapak)->sum('qty'),
            'stok'              => Produk::where('pelapak_id', $id_pelapak)->sum('stok'),
            'pendapatan'        => 0
        ];

        $chart_2                = [];

        $nama_bulan             = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $tgl_pesan              = RiwayatPesanan::join('transaksi', 'id_transaksi', 'transaksi_id')->join('order_detail', 'id_order_detail', 'transaksi.order_detail_id')->join('order_item', 'id_order_detail', 'order_item.order_detail_id')->join('produk', 'id_produk', 'order_item.produk_id')->where('pelapak_id', $id_pelapak)->where('tgl_pesan', 'like', date('Y').'-%')->orderBy('tgl_pesan')->get();        

        foreach(OrderItem::join('produk', 'id_produk', 'order_item.produk_id')->where('pelapak_id', $id_pelapak)->get() as $item)
        {
            $data['pendapatan'] += ($item->harga - $item->fee_admin) * $item->qty;
        }

        foreach ($tgl_pesan as $tgl)
        {
            $month_number   = explode('-', explode(' ', $tgl->tgl_pesan)[0])[1];

            if (array_key_exists($month_number, $chart_2))
            {
                $chart_2[$month_number]['data'] = $chart_2[$month_number]['data'] + ($tgl->harga - $tgl->fee_admin) * $tgl->qty;
            }
            else
            {
                $chart_2[$month_number]['bulan']    = $nama_bulan[(int) $month_number - 1];
                $chart_2[$month_number]['data']     = ($tgl->harga - $tgl->fee_admin) * $tgl->qty;
            }
        }

        $data['chart_2']    = $chart_2;
        
        return view('shop.report', $data);
    }
}

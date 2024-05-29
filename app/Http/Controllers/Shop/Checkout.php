<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use App\Models\Keranjang;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\Pembayaran;
use App\Models\RiwayatPesanan;
use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Saldo;

class Checkout extends Controller
{
    public function add(CheckoutRequest $request)
    {
        if (! preg_match('/^[0-9]*$/', $request->telepon))
        {
            return redirect()->back()->withErrors(['Nomor Telepon harus berupa angka.']);
        }

        $id_pembeli         = $request->session()->get('id_pembeli');
        $keranjang          = Keranjang::where('pembeli_id', $id_pembeli)->get();
        $metode_pembayaran  = $request->metode_pembayaran;
        $telepon            = $request->telepon;
        $email              = $request->email;
        $alamat             = $request->alamat;
        $catatan            = $request->catatan;
        // $ongkir             = $request->ongkir;
        $total_bayar        = $request->total_bayar;
        $total_fee_admin    = 0;
        $fee_admin          = 0;

        if ($metode_pembayaran === 'Transfer Bank')
        {
            if (! $request->bukti_transfer)
            {
                return redirect()->back()->withErrors(['Mohon menyertakan bukti transfer.']);
            }

            if (strpos($request->bukti_transfer->getMimeType(), 'image') === false)
            {
                return redirect()->back()->withErrors(['Bukti transfer harus berupa file gambar.']);
            }

            if (! $request->rekening)
            {
                return redirect()->back()->withErrors(['Rekening belum dipilih']);
            }
        }

        $id_order_detail    = OrderDetail::insertGetId([
            'pembeli_id'        => $id_pembeli,
            'alamat_penerima'   => $alamat,
            'telepon_penerima'  => $telepon,
            'email_penerima'    => $email,
            'keterangan'        => $catatan
        ]);

        foreach ($keranjang as $item)
        {   
            $harga_produk       = Produk::where('id_produk', $item->produk_id)->first()->harga;
            $persen_potongan    = 0;

            if ($harga_produk <= 75000)
            {
                $persen_potongan = 1;
            }
            else if ($harga_produk > 75000 && $harga_produk <= 150000)
            {
                $persen_potongan = 2;
            }
            else if ($harga_produk > 150000 && $harga_produk <= 225000)
            {
                $persen_potongan = 3;
            }
            else if ($harga_produk > 225000 && $harga_produk <= 300000)
            {
                $persen_potongan = 4;
            }
            else
            {
                $persen_potongan = 5;
            }

            $fee_admin          = $harga_produk * ($persen_potongan / 100);
            $total_fee_admin    += $fee_admin * $item->qty;

            OrderItem::insert([
                'produk_id'         => $item->produk_id,
                'order_detail_id'   => $id_order_detail,
                'qty'               => $item->qty,
                'ukuran'            => $item->ukuran_terpilih,
                'status'            => 'menunggu konfirmasi',
                'fee_admin'         => $fee_admin
            ]);
        }

        $id_pembayaran      = Pembayaran::insertGetId([
            'metode_pembayaran'     => $metode_pembayaran,
            'tgl_bayar'             => date('Y-m-d H:i:s'),
            // 'ongkir'                => $ongkir,
            'total_fee_admin'       => $total_fee_admin,
            'total_bayar'           => $total_bayar
        ]);

        if ($metode_pembayaran === 'Transfer Bank')
        {
            $file_name  = $id_pembayaran.'.'.$request->bukti_transfer->extension();
            $request->bukti_transfer->move(public_path('bukti_transfer'), $file_name);

            Pembayaran::where('id_pembayaran', $id_pembayaran)->update([
                'bukti_transfer'    => 'bukti_transfer/'.$file_name,
                'rekening_id'       => $request->rekening
            ]);
        }

        $id_transaksi   = Transaksi::insertGetId([
            'pembeli_id'        => $id_pembeli,
            'pembayaran_id'     => $id_pembayaran,
            'order_detail_id'   => $id_order_detail
        ]);

        RiwayatPesanan::insert([
            'transaksi_id'  => $id_transaksi,
            'pembeli_id'    => $id_pembeli,
            'tgl_pesan'     => date('Y-m-d H:i:s')
        ]);

        Keranjang::where('pembeli_id', $id_pembeli)->delete();

        foreach ($keranjang as $item)
        {
            $stok               = Produk::where('id_produk', $item->produk_id)->first()->stok;
            $id_pelapak         = Produk::where('id_produk', $item->produk_id)->first()->pelapak_id;
            $saldo              = Saldo::where('pelapak_id', $id_pelapak)->first()->nominal;
            $harga_produk       = Produk::where('id_produk', $item->produk_id)->first()->harga;

            $persen_potongan    = 0;

            if ($harga_produk <= 75000)
            {
                $persen_potongan = 1;
            }
            else if ($harga_produk > 75000 && $harga_produk <= 150000)
            {
                $persen_potongan = 2;
            }
            else if ($harga_produk > 150000 && $harga_produk <= 225000)
            {
                $persen_potongan = 3;
            }
            else if ($harga_produk > 225000 && $harga_produk <= 300000)
            {
                $persen_potongan = 4;
            }
            else
            {
                $persen_potongan = 5;
            }

            Produk::where('id_produk', $item->produk_id)->update([
                'stok'  => $stok - $item->qty
            ]);

            if ($metode_pembayaran === 'Transfer Bank')
            {
                Saldo::where('pelapak_id', $id_pelapak)->update([
                    'nominal'   => $saldo + (($harga_produk * ((100 - $persen_potongan) / 100)) * $item->qty)
                ]);   
            }
            else
            {
                Saldo::where('pelapak_id', $id_pelapak)->update([
                    'nominal'   => $saldo - (($harga_produk * ($persen_potongan / 100)) * $item->qty)
                ]);
            }
        }
        
        return redirect()->route('shop.customer.account');
    }
}

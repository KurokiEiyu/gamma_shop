<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelapak;
use App\Models\Pembayaran;
use App\Models\Pembeli;
use App\Models\Produk;
use App\Models\RiwayatPesanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class Report extends Controller
{
    public function index()
    {
        $nama_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $jumlah_pembeli     = Pembeli::count();
        $jumlah_pelapak     = Pelapak::count();
        $jumlah_produk      = Produk::count();
        $jumlah_transaksi   = Transaksi::count();

        $tgl_pesan          = RiwayatPesanan::select('tgl_pesan', 'pembayaran.total_fee_admin')->join('transaksi', 'id_transaksi', 'transaksi_id')->join('pembayaran', 'id_pembayaran', 'transaksi.pembayaran_id')->where('tgl_pesan', 'like', date('Y').'-%')->orderBy('tgl_pesan')->get();

        $data_chart         = [];
        $chart_2            = [];

        foreach($tgl_pesan as $tgl)
        {
            $month_number   = explode('-', explode(' ', $tgl->tgl_pesan)[0])[1];

            if (array_key_exists($month_number, $data_chart))
            {
                $data_chart[$month_number]['transaksi']  = $data_chart[$month_number]['transaksi'] + 1;
            }
            else
            {
                $data_chart[$month_number]['bulan']      = $nama_bulan[(int) $month_number - 1];
                $data_chart[$month_number]['transaksi']  = 1;
                $data_chart[$month_number]['volume']     = Pembayaran::join('transaksi', 'transaksi.pembayaran_id', 'id_pembayaran')
                                                        ->join('riwayat_pesanan', 'riwayat_pesanan.transaksi_id', 'id_transaksi')
                                                        ->where('tgl_pesan', 'like', date('Y').'-'.$month_number.'-%')
                                                        ->sum('pembayaran.total_bayar');
            }

            if (array_key_exists($month_number, $chart_2))
            {
                $chart_2[$month_number]['data'] = $chart_2[$month_number]['data'] + $tgl->total_fee_admin;
            }
            else
            {
                $chart_2[$month_number]['bulan']    = $nama_bulan[(int) $month_number - 1];
                $chart_2[$month_number]['data']     = $tgl->total_fee_admin;
            }
        }

        $pendapatan_hari_ini    = RiwayatPesanan::join('transaksi', 'id_transaksi', 'transaksi_id')->join('pembayaran', 'id_pembayaran', 'transaksi.pembayaran_id')->where('tgl_pesan', 'like', '%'.date('Y-m-d').'%')->orderBy('tgl_pesan')->sum('pembayaran.total_fee_admin');
        $pendapatan_bulan_ini   = RiwayatPesanan::join('transaksi', 'id_transaksi', 'transaksi_id')->join('pembayaran', 'id_pembayaran', 'transaksi.pembayaran_id')->where('tgl_pesan', 'like', '%-'.date('m').'-%')->orderBy('tgl_pesan')->sum('pembayaran.total_fee_admin');

        return view('admin.report')->with(compact('jumlah_pembeli', 'jumlah_pelapak', 'jumlah_produk', 'jumlah_transaksi', 'data_chart', 'pendapatan_hari_ini', 'pendapatan_bulan_ini', 'chart_2'));
    }
}

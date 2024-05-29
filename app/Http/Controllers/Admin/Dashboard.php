<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Pembeli;
use App\Models\Pelapak;
use App\Models\Produk;
use App\Models\RiwayatPesanan;

class Dashboard extends Controller
{
    public function index(Request $request)
    {
        $id_admin = $request->session()->get('id_admin');

        // $tgl_pesan  = RiwayatPesanan::select('tgl_pesan')->where('tgl_pesan', 'like', date('Y').'-%')->get();
        $tgl_pesan              = RiwayatPesanan::select('tgl_pesan', 'pembayaran.total_fee_admin')->join('transaksi', 'id_transaksi', 'transaksi_id')->join('pembayaran', 'id_pembayaran', 'transaksi.pembayaran_id')->where('tgl_pesan', 'like', date('Y').'-%')->orderBy('tgl_pesan')->get();
        $nama_bulan             = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $pendapatan_hari_ini    = RiwayatPesanan::join('transaksi', 'id_transaksi', 'transaksi_id')->join('pembayaran', 'id_pembayaran', 'transaksi.pembayaran_id')->where('tgl_pesan', 'like', '%'.date('Y-m-d').'%')->orderBy('tgl_pesan')->sum('pembayaran.total_fee_admin');
        $pendapatan_bulan_ini   = RiwayatPesanan::join('transaksi', 'id_transaksi', 'transaksi_id')->join('pembayaran', 'id_pembayaran', 'transaksi.pembayaran_id')->where('tgl_pesan', 'like', '%-'.date('m').'-%')->orderBy('tgl_pesan')->sum('pembayaran.total_fee_admin');
        $chart                  = [];
        $chart_2                = [];

        foreach ($tgl_pesan as $tgl)
        {
            $month_number   = explode('-', explode(' ', $tgl->tgl_pesan)[0])[1];

            if (array_key_exists($month_number, $chart))
            {
                $chart[$month_number]['data']   = $chart[$month_number]['data'] + 1;
            }
            else
            {
                $chart[$month_number]['bulan']  = $nama_bulan[(int) $month_number - 1];
                $chart[$month_number]['data']   = 1;
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

        $data = [
            'nama_admin'            => Admin::where('id_admin', $id_admin)->first()->nama_lengkap,
            'jumlah_transaksi'      => RiwayatPesanan::where('tgl_pesan', 'like', '%'.date('Y-m-d').'%')->count(),
            'jumlah_pembeli'        => Pembeli::count(),
            'jumlah_pelapak'        => Pelapak::count(),
            'jumlah_produk'         => Produk::count(),
            'chart'                 => $chart,
            'chart_2'               => $chart_2,
            'pendapatan_hari_ini'   => $pendapatan_hari_ini,
            'pendapatan_bulan_ini'  => $pendapatan_bulan_ini
        ];

        return view('admin.dashboard', $data);
    }
}
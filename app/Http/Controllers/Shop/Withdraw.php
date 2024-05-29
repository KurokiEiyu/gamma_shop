<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\WithdrawRequest;
use App\Models\Saldo;
use App\Models\Withdraw as ModelsWithdraw;
use Illuminate\Http\Request;

class Withdraw extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'id_pelapak'    => $request->session()->get('id_pelapak')
        ];

        return view('shop.withdraw', $data);
    }

    public function send(WithdrawRequest $request)
    {
        if (! preg_match('/^[0-9]*$/', $request->no_rekening))
        {
            return redirect()->back()->withErrors(['No. Rekening harus berupa angka.']);
        }

        $current_saldo  = Saldo::where('pelapak_id', $request->session()->get('id_pelapak'))->first()->nominal;

        if ($request->nominal > $current_saldo)
        {
            return redirect()->back()->withErrors(['Saldo tidak mencukupi']);
        }

        ModelsWithdraw::insert([
            'pelapak_id'    => $request->session()->get('id_pelapak'),
            'tgl_withdraw'  => date('Y-m-d H:i:s'),
            'nominal'       => $request->nominal,
            'nama_bank'     => $request->nama_bank,
            'no_rek_tujuan' => $request->no_rekening,
            'atas_nama'     => $request->atas_nama,
            'status'        => 'menunggu konfirmasi'
        ]);

        return redirect()->route('shop.seller.mystore');
    }

    public function history(Request $request)
    {
        $data = [
            'withdraws' => ModelsWithdraw::where('pelapak_id', $request->session()->get('id_pelapak'))->orderBy('id_withdraw', 'desc')->get()
        ];

        return view('shop.withdraw_history', $data);
    }
}

<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositRequest;
use App\Models\Deposit as ModelsDeposit;
use App\Models\Rekening;
use Illuminate\Http\Request;

class Deposit extends Controller
{
    public function index()
    {
        $data = [
            'rekenings' => Rekening::get()
        ];

        return view('shop.deposit', $data);
    }

    public function send(DepositRequest $request)
    {
        $id_deposit = ModelsDeposit::insertGetId([
            'pelapak_id'    => $request->session()->get('id_pelapak'),
            'rekening_id'   => $request->rekening,
            'nominal'       => $request->nominal,
            'tgl_deposit'   => date('Y-m-d H:i:s'),
            'status'        => 'menunggu konfirmasi'
        ]);

        $nama_file  = 'deposit-'.$id_deposit.'.'.$request->bukti_transfer->extension();

        $request->bukti_transfer->move(public_path('bukti_transfer'), $nama_file);

        ModelsDeposit::where('id_deposit', $id_deposit)->update([
            'bukti_transfer'    => 'bukti_transfer/'.$nama_file
        ]);

        return redirect()->route('shop.seller.mystore');
    }

    public function history(Request $request)
    {
        $data = [
            'deposits'  => ModelsDeposit::where('pelapak_id', $request->session()->get('id_pelapak'))->orderBy('id_deposit', 'desc')->get()
        ];

        return view('shop.deposit_history', $data);
    }
}

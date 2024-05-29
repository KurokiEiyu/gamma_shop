<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Deposit;
use App\Models\Saldo;
use Illuminate\Http\Request;

class DepositList extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'nama_admin'    => Admin::where('id_admin', $request->session()->get('id_admin'))->first()->nama_lengkap,
            'deposits'      => Deposit::join('pelapak', 'id_pelapak', 'pelapak_id')->where('status', 'menunggu konfirmasi')->get()
        ];

        return view('admin.deposit', $data);
    }

    public function update(Request $request)
    {
        if ($request->status === 'diterima')
        {
            Deposit::where('id_deposit', $request->id_deposit)->update([
                'status'    => $request->status
            ]);

            $current_saldo  = Saldo::where('pelapak_id', $request->pelapak_id)->first()->nominal;

            Saldo::where('pelapak_id', $request->pelapak_id)->update([
                'nominal'   => $current_saldo + $request->nominal
            ]);
        }

        return redirect()->back();
    }
}

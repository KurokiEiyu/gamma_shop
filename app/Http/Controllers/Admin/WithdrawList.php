<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Saldo;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawList extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'nama_admin'    => Admin::where('id_admin', $request->session()->get('id_admin'))->first()->nama_lengkap,
            'withdraws'     => Withdraw::join('pelapak', 'id_pelapak', 'pelapak_id')->where('status', 'menunggu konfirmasi')->get()
        ];

        return view('admin.withdraw', $data);
    }

    public function update(Request $request)
    {
        if ($request->status === "disetujui")
        {
            Withdraw::where('id_withdraw', $request->id_withdraw)->update([
                'status'    => $request->status
            ]);

            $current_saldo  = Saldo::where('pelapak_id', $request->pelapak_id)->first()->nominal;

            Saldo::where('pelapak_id', $request->pelapak_id)->update([
                'nominal'   => $current_saldo - $request->nominal
            ]);
        }

        return redirect()->back();
    }
}

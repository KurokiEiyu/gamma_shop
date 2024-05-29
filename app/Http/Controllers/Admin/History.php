<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Deposit;
use App\Models\Withdraw;

class History extends Controller
{
    public function deposit(Request $request)
    {
        $id_admin = $request->session()->get('id_admin');

        $data = [
            'nama_admin'    => Admin::where('id_admin', $id_admin)->first()->nama_lengkap,
            'deposits'      => Deposit::join('pelapak', 'id_pelapak', 'deposit.pelapak_id')->where('status', 'diterima')->orderBy('id_deposit', 'desc')->get()
        ];

        return view('admin.deposit_list', $data);
    }

    public function withdraw(Request $request)
    {
        $id_admin = $request->session()->get('id_admin');

        $data = [
            'nama_admin'    => Admin::where('id_admin', $id_admin)->first()->nama_lengkap,
            'withdraws'     => Withdraw::join('pelapak', 'id_pelapak', 'withdraw.pelapak_id')->where('status', 'disetujui')->orderBy('id_withdraw', 'desc')->get()
        ];

        return view('admin.withdraw_list', $data);
    }
}

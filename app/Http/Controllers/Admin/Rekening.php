<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RekeningRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Rekening as ModelRekening;

class Rekening extends Controller
{
    public function index(Request $request)
    {
        $id_admin = $request->session()->get('id_admin');

        $data   = [
            'nama_admin'        => Admin::where('id_admin', $id_admin)->first()->nama_lengkap,
            'rekenings'         => ModelRekening::get()
        ];

        return view('admin.rekening', $data);
    }

    public function add(Request $request)
    {
        $id_admin = $request->session()->get('id_admin');

        $data   = [
            'nama_admin'        => Admin::where('id_admin', $id_admin)->first()->nama_lengkap
        ];

        return view('admin.rekening_add', $data);
    }

    public function add_process(RekeningRequest $request)
    {
        if (! preg_match('/^[0-9]*$/', $request->no_rekening))
        {
            return redirect()->back()->withErrors(['Nomor Rekening harus berupa angka.']);
        }

        ModelRekening::insert([
            'nama_bank'     => $request->nama_bank,
            'atas_nama'     => $request->atas_nama,
            'no_rekening'   => $request->no_rekening
        ]);

        return redirect()->route('admin.data.rekening');
    }

    public function edit(Request $request, $id_rekening)
    {
        $id_admin = $request->session()->get('id_admin');

        $data   = [
            'nama_admin'        => Admin::where('id_admin', $id_admin)->first()->nama_lengkap,
            'rekening'          => ModelRekening::where('id_rekening', $id_rekening)->first()
        ];

        if (! $data['rekening'])
        {
            return redirect()->back();
        }

        return view('admin.rekening_edit', $data);
    }

    public function edit_process(RekeningRequest $request)
    {
        if (! preg_match('/^[0-9]*$/', $request->no_rekening))
        {
            return redirect()->back()->withErrors(['Nomor Rekening harus berupa angka.']);
        }

        ModelRekening::where('id_rekening', $request->id_rekening)->update([
            'nama_bank'     => $request->nama_bank,
            'atas_nama'     => $request->atas_nama,
            'no_rekening'   => $request->no_rekening
        ]);

        return redirect()->route('admin.data.rekening');
    }

    public function delete_process(Request $request)
    {
        ModelRekening::where('id_rekening', $request->id_rekening)->delete();

        return redirect()->back();
    }
}

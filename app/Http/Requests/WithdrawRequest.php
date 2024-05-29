<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_bank'     => 'required',
            'no_rekening'   => 'required',
            'atas_nama'     => 'required',
            'nominal'       => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama_bank.required'    => 'Nama Bank tidak boleh kosong.',
            'no_rekening.required'  => 'No. Rekening Tujuan tidak boleh kosong.',
            'atas_nama.required'    => 'Nama Pemilik Rekening tidak boleh kosong.',
            'nominal.required'      => 'Nominal tidak boleh kosong.'
        ];
    }
}

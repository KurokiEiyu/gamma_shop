<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositRequest extends FormRequest
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
            'rekening'  => 'required',
            'nominal'   => 'required',
            'bukti_transfer'    => 'required|image'
        ];
    }

    public function messages()
    {
        return [
            'rekening.required'         => 'Rekening tujuan belum dipilih.',
            'nominal.required'          => 'Nominal belum dimasukan.',
            'bukti_transfer.required'   => 'Bukti Transfer belum dimasukan.',
            'bukti_transfer.image'      => 'File Bukti Transfer harus berupa gambar.'
        ];
    }
}

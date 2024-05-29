<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RekeningRequest extends FormRequest
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
            'atas_nama'     => 'required',
            'no_rekening'   => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama_bank.required'    => 'Nama Bank tidak boleh kosong.',
            'atas_nama.required'    => 'Atas Nama tidak boleh kosong',
            'no_rekening.required'  => 'No Rekening tidak boleh kosong'
        ];
    }
}

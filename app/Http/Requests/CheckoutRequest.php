<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'metode_pembayaran' => 'required',
            'telepon'           => 'required',
            'alamat'            => 'required'
        ];
    }

    public function messages()
    {
        return [
            'metode_pembayaran.required'    => 'Metode pembayaran belum dipilih.',
            'telepon.required'              => 'Nomor telepon harus diisi.',
            'alamat.required'               => 'Alamat tidak boleh kosong.'
        ];
    }
}

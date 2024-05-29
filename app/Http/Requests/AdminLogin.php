<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLogin extends FormRequest
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
            'nama_pengguna'         => 'required',
            'kata_sandi'            => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama_pengguna.required'            => 'Nama Pengguna tidak boleh kosong.',
            'kata_sandi.required'               => 'Kata Sandi tidak boleh kosong.'
        ];
    }
}

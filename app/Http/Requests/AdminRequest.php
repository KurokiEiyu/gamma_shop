<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'nama_lengkap'          => 'required',
            'nama_pengguna'         => 'required',
            'email'                 => 'required',
            'kata_sandi'            => 'required',
            'konfirmasi_kata_sandi' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama_lengkap.required'             => 'Nama Lengkap tidak boleh kosong',
            'nama_pengguna.required'            => 'Nama Pengguna tidak boleh kosong.',
            'email.required'                    => 'Email tidak boleh kosong',
            'kata_sandi.required'               => 'Kata Sandi tidak boleh kosong.',
            'konfirmasi_kata_sandi.required'    => 'Konfirmasi Kata Sandi tidak boleh kosong.'
        ];
    }
}

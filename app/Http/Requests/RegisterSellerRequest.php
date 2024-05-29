<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterSellerRequest extends FormRequest
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
            'nama_toko'             => 'required',
            'nama_pemilik'          => 'required',
            'nama_pengguna'         => 'required',
            'email'                 => 'required',
            'telepon'               => 'required',
            'alamat'                => 'required',
            'jenis_kelamin'         => 'required',
            'kata_sandi'            => 'required',
            'konfirmasi_kata_sandi' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama_toko.required'                => 'Nama Toko tidak boleh kosong',
            'nama_pemilik.required'             => 'Nama Pemilik tidak boleh kosong.',
            'nama_pengguna.required'            => 'Nama Pengguna tidak boleh kosong.',
            'email.required'                    => 'Email tidak boleh kosong.',
            'telepon.required'                  => 'Telepon tidak boleh kosong.',
            'alamat.required'                   => 'Alamat tidak boleh kosong.',
            'jenis_kelamin.required'            => 'Jenis Kelamin belum dipilih.',
            'kata_sandi.required'               => 'Kata sandi tidak boleh kosong.',
            'konfirmasi_kata_sandi.required'    => 'Konfirmasi kata sandi tidak boleh kosong.'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukRequest extends FormRequest
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
            'nama_produk'   => 'required',
            'kategori'      => 'required',
            'ukuran'        => 'required',
            'deskripsi'     => 'required',
            'foto_1'        => 'required|mimes:jpg',
            'foto_2'        => 'mimes:jpg',
            'foto_3'        => 'mimes:jpg',
            'stok'          => 'required',
            'harga'         => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama_produk.required'  => 'Nama produk tidak boleh kosong.',
            'kategori.required'     => 'Kategori belum dipilih.',
            'ukuran.required'       => 'Ukuran tidak boleh kosong.',
            'deskripsi.required'    => 'Deskripsi tidak boleh kosong.',
            'foto_1.required'       => 'Foto 1 tidak boleh kosong.',
            'foto_1.mimes'          => 'Foto 1 harus berupa file .jpg',
            'foto_2.mimes'          => 'Foto 2 harus berupa file .jpg',
            'foto_3.mimes'          => 'Foto 3 harus berupa file .jpg',
            'stok.required'         => 'Stok harus diisi.',
            'harga.required'        => 'Harga tidak boleh kosong.'
        ];
    }
}

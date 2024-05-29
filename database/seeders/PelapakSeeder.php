<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PelapakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pelapak')->insert([
            'nama_toko'     => 'Pelapak Store',
            'nama_pemilik'  => 'Pelapak',
            'nama_pengguna' => 'pelapak',
            'email'         => 'pelapak@gmail.com',
            'telepon'       => '123456789',
            'alamat'        => 'Indonesia',
            'jenis_kelamin' => 'L',
            'kata_sandi'    => Hash::make('pelapak')
        ]);
    }
}

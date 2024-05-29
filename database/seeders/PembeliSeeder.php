<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PembeliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pembeli')->insert([
            'nama_lengkap'  => 'Pembeli',
            'nama_pengguna' => 'pembeli',
            'email'         => 'pembeli@gmail.com',
            'telepon'       => '123456789',
            'alamat'        => 'Indonesia',
            'jenis_kelamin' => 'L',
            'kata_sandi'    => Hash::make('pembeli')
        ]);
    }
}

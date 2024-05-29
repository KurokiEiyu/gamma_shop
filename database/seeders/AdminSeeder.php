<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'nama_lengkap'  => 'Administrator',
            'email'         => 'admin@gmail.com',
            'nama_pengguna' => 'admin',
            'kata_sandi'    => Hash::make('admin')
        ]);
    }
}

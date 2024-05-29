<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rekening')->insert([
            'nama_bank'     => 'BCA',
            'atas_nama'     => 'Developer',
            'no_rekening'   => '123456789'
        ]);
    }
}

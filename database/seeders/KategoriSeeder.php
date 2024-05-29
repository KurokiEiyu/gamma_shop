<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = [
            'Pakaian Pria',
            'Pakaian Wanita',
            'Pakaian Anak',
            'Sepatu',
            'Aksesoris'
        ];

        for ($i = 1; $i <= 5; $i++)
        {
            DB::table('kategori')->insert([
                'admin_id'      => 1,
                'nama_kategori' => $kategori[$i - 1]
            ]);
        }
    }
}

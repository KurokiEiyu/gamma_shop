<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++)
        {
            DB::table('produk')->insert([
                'pelapak_id'    => 1,
                'kategori_id'   => $i,
                'nama_produk'   => 'Contoh Produk '.$i,
                'deskripsi'     => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae praesentium, commodi porro consequuntur modi rem doloremque! Rerum dolorem molestiae odio, repellat voluptatibus, aliquam ipsam dicta facere magni nostrum eum eveniet?',
                'ukuran'        => 'S, M, L, XL',
                'path_foto'     => 'foto_produk/',
                'harga'         => 100000,
                'stok'          => 10
            ]);
        }
    }
}

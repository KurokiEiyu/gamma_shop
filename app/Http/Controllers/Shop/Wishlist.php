<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorit;

class Wishlist extends Controller
{
    public function add(Request $request)
    {
        $id_pembeli = $request->session()->get('id_pembeli');

        if (count(Favorit::where('pembeli_id', $id_pembeli)->where('produk_id', $request->product_id)->get()) === 0) {

            Favorit::insert(
                [
                    'pembeli_id'    => 1,
                    'produk_id'     => $request->product_id
                ]
            );

            $favorites = Favorit::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $id_pembeli)->get();
            $fav = [];

            foreach ($favorites as $favorite)
            {
                array_push($fav, $favorite);
            }

            return response()->json([
                'status'    => 'success',
                'data'      => $fav
            ]);

        } else {
            return response()->json([
                'status'    => 'failed'
            ]);
        }
    }

    public function delete(Request $request)
    {
        $id_pembeli = $request->session()->get('id_pembeli');
        
        if (Favorit::where('id_favorit', $request->id_favorit)->delete())
        {
            $favorites = Favorit::join('produk', 'produk_id', 'produk.id_produk')->where('pembeli_id', $id_pembeli)->get();
            $fav = [];

            foreach ($favorites as $favorite)
            {
                array_push($fav, $favorite);
            }

            return response()->json([
                'status'    => 'success',
                'data'      => $fav
            ]);
        }
        else
        {
            return response()->json([
                'status'    => 'failed'
            ]);
        }
    }
}

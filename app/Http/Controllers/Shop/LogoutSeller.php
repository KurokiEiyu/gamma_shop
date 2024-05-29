<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutSeller extends Controller
{
    public function index(Request $request)
    {
        $request->session()->forget('id_pelapak');

        return redirect()->route('shop.home');
    }
}

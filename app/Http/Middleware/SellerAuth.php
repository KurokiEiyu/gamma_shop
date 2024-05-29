<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SellerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (($request->session()->has('id_pelapak') && $request->url() === route('shop.seller.login'))
            || (! $request->session()->has('id_pelapak') && $request->url() !== route('shop.seller.login')))
        {
            return redirect()->route('shop.seller.login');
        }

        return $next($request);
    }
}

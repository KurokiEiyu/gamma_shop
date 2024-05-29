<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerAuth
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
        if (($request->session()->has('id_pembeli') && $request->url() === route('shop.customer.login'))
            || (! $request->session()->has('id_pembeli') && $request->url() !== route('shop.customer.login')))
        {
            return redirect()->route('shop.customer.login');
        }

        return $next($request);
    }
}

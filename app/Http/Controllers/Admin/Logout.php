<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Logout extends Controller
{
    public function index(Request $request)
    {
        $request->session()->forget('id_admin');
        return redirect()->route('admin.login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __invoke()
    {
        if(!auth()->check() || auth()->user()->is_admin !== 1) {
            return redirect()->route('admin.login')->with('error', 'Access denied!');
        }else{
            return view('admin');
        }
    }
}

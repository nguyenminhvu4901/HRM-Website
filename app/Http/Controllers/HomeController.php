<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = "Trang chu nhe";
        // $data['a'] = "ki lum me";
        // $data['b'] = "hehe me";

        return view('clients.dashboard', compact('data'));
    }

    public function products()
    {
        $data = [];
        $data['title'] = "Trang product";
        return view('clients.product', compact('data'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PDController extends Controller
{
    public function index()
    {
        return view('product-development.index');
    }
}

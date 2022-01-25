<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DPController extends Controller
{
    public function index(){
        return view('design-product.index');
    }
}

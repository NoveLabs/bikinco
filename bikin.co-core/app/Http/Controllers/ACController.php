<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ACController extends Controller
{
    public function index(){
        return view('accounting.index');
    }
}

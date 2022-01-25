<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SOController extends Controller
{
    public function index(){
        return view('sales-officer.index');
    }
}

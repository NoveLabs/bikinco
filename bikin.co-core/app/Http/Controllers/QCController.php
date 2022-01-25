<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QCController extends Controller
{
    public function index(){
        return view('quality-control.index');
    }
}

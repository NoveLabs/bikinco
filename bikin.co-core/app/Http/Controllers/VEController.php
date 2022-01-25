<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VEController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:vendor');	
    }


    public function index()
    {
    	return view('vendor.index');
    }

}

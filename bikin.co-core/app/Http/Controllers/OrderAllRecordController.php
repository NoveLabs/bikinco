<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\Order;

class OrderAllRecordController extends Controller
{
	private $modelOrder;

    public function __construct()
    {
    	$this->modelOrder = new Order();
    }

    public function index()
    {
    	$data = $this->modelOrder->getAllRecord();

    	return view('order-allrecord.index', compact('data'));
    }
}

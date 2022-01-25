<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\Order;

use App\Http\Models\OrderLog;


class OrderSelesaiController extends Controller
{
    private $modelOrder;
    
    public function __construct()
    {
    	$this->middleware('auth');
    	$this->modelOrder = new Order();
    }

    public function index()
    {
    	$data = $this->modelOrder->getDataOrderArrived();

        $dataLog = OrderLog::GetDataLogAll()->get();

    	return view('order-selesai.index', compact('data', 'dataLog'));
    }
}

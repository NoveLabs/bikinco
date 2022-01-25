<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\Order;

use App\Http\Models\Categories;

use Illuminate\Support\Facades\Auth;

class VendorOrderMasukController extends Controller
{
	private $modelOrder;
	private $modelCategories;

	public function __construct()
    {
        $this->middleware('auth');
        $this->modelOrder = new Order();
        $this->modelCategories = new Categories();
    }

    public function index()
    {	
        $id =  Auth::guard('vendor')->user()->id;
        
        $data = $this->modelOrder->getDataOrderMasukVendor($id);

        $count = count($data);

        $product = $this->modelCategories->getDataCategories();

    	return view('vendor.order-masuk.index', compact('data','product', 'count'));
    }

    public function getDataOrderMasuk()
    {
        $id =  Auth::guard('vendor')->user()->id;

        $data = $this->modelOrder->getDataOrderMasukVendor($id);

        $counted = count($data);

        return $counted;
    }
}

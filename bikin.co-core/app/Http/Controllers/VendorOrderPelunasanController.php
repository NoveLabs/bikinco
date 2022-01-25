<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\Order;

use App\Http\Models\Categories;

use Illuminate\Support\Facades\Auth;


class VendorOrderPelunasanController extends Controller
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

    	$data = $this->modelOrder->GetDataOrderPelunasanVendor($id);

        $count = count($data);

    	$product = $this->modelCategories->getDataCategories();

    	return view('vendor.order-pelunasan.index', compact('data','product', 'count'));
    }

    public function getImagePelunasan($id)
    {
    	$data = $this->modelOrder->getImagePelunasan($id);

    	return $data;
    }

    public function getDataOrderPelunasanVendor()
    {
        $id =  Auth::guard('vendor')->user()->id;

        $data = $this->modelOrder->getDataOrderPelunasanVendor($id);

        $counted = count($data);
        
        return $counted;
    }
}

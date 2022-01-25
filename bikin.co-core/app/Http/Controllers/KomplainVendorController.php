<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\Order;

use App\Http\Models\ComplainVendor;

use Illuminate\Support\Facades\Auth;


class KomplainVendorController extends Controller
{
	private $modelOrder;
    private $modelComplainVendor;
    
    public function __construct()
    {
    	$this->modelOrder = new Order();
        $this->modelComplainVendor = new ComplainVendor();

    }

    public function index()
    {
        $id =  Auth::guard('vendor')->user()->id;

    	$data = $this->modelOrder->getComplainVendor($id);

    	return view('complain-vendor.index', compact('data'));
    }

    public function getDataComplain()
    {
        $id =  Auth::guard('vendor')->user()->id;

        $data = $this->modelOrder->getComplainVendor($id);

        $counted = count($data);

        return $counted;
    }

    public function updateKomplain(Request $request)
    {
        $input = [
            'order_id' => $request->id,
            'complain_type' => $request->jenis_komplain,
            'notes' => $request->notes,
            'attachment' => $request->lampiran,
            'status' => 2
        ];

        $create = $this->modelComplainVendor->create($input);

        if(!$create){
            return response()->json([
            'status' => true,
            'data' => '',
            'message' => 'Komplain Vendor Gagal'
            ], 200);
        }

        return response()->json([
            'status' => true,
            'data' => '',
            'message' => 'Komplain Vendor berhasil'
            ], 200);
    }	
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\Order;

use App\Http\Models\Categories;

use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\Auth;


class VendorOrderSelesaiController extends Controller
{
    private $modelOrder;
	private $modelCategories;

	public function __construct()
    {
        $this->middleware('auth');
        $this->modelOrder = new Order();
        $this->modelCategories = new Categories();
    }

    public function index(Request $request)
    {
    	if ($request->ajax()) {
            $id =  Auth::guard('vendor')->user()->id;

	    	$data = $this->modelOrder->getDataVendorSelesai($id);

	    	return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('priority', function ($row) {
                        return $row->priority == 1 ? '<span class="uk-label uk-label-danger">PRIORITAS</span>' : '<span class="uk-label">TIDAK PRIORITAS</span>';
                    })
                    ->editColumn('flow_step', function($row){
                    	$flow_step = $row->flow_step;

                    	if ($flow_step == 10) {
                        	$last_status = '<span class="uk-label uk-label-success">ORDER SELESAI TANPA KOMPLAIN</span>';
                        } else if ($flow_step == 11) {
                        	$last_status = '<span class="uk-label uk-label-danger">ORDER SELESAI DENGAN KOMPLAIN</span>';
                        }

                        return $last_status;
                    })
                    ->addColumn('keterangan', function($row) {
                        $flow_step = $row->flow_step;
                        if ($flow_step == 10) {
                        	$text = '<span class="uk-label uk-label-success">SELESAI TANPA KOMPLAIN</span>';
                        } else if ($flow_step == 11) {
                        	$text = '<span class="uk-label uk-label-danger">SELESAI DENGAN KOMPLAIN</span>';
                        }
                        return $text;

                    })
                    ->rawColumns(['priority', 'keterangan', 'flow_step'])
                    ->make(true);

    	}

    	return view('vendor.order-selesai.index');
    }

    public function getDataSelesaiVendor()
    {
        $id =  Auth::guard('vendor')->user()->id;

        $data = $this->modelOrder->getDataVendorSelesai($id);

        $counted = count($data);

        return $counted;
    }
}

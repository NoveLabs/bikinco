<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\Order;

use App\Http\Models\OrderLog;

use App\Http\Models\ComplainVendor;



class QCSelesaiProduksiController extends Controller
{
	private $modelOrder;
	private $modelOrderLog;
	private $modelComplainVendor;

    public function __construct()
    {
        $this->middleware('auth');
    	$this->modelOrderLog = new OrderLog();
        $this->modelOrder = new Order();
        $this->modelComplainVendor = new ComplainVendor();
    }

    public function index()
    {
    	$data = $this->modelOrder->getDataOrderSelesaiProduksi();

        $dataLog = OrderLog::GetDataLogAll()->get();

    	return view('quality-control.selesai-produksi.index', compact('data', 'dataLog'));
    }

    public function complainIndex()
    {
        $data = $this->modelOrder->getDataComplainQCV();

        $count = count($data);

        return view('quality-control.dalam-komplain.index', compact('data', 'count'));
    }

    public function getComplain($id)
    {
        $data = $this->modelOrder->getSingleComplainQCV($id);
        
        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data Image Ditemukan',
        ], 200);
    }

    public function updateSesuai($id)
    {
    	
    	$updateStatus = [
            'flow_step' => 6,
            'flow_step_date' => now(),
        ];

       $detail = $this->modelOrder->getDataOrderById($id);

       $detail->update($updateStatus);

       $inputLogOrder = [
            'order_id' => $id,
            'flow_step' => 6,
            'flow_step_date' => now(),
       ];

       $createLogOrder = $this->modelOrderLog->create($inputLogOrder);

        return response()->json([
            'status' => true,
            'data' => '',
            'message' => 'Order telah dikonfirmasi sesuai'
        ], 200);

    }

    public function updateKomplain(Request $request)
    {
    	$input = [
    		'order_id' => $request->id,
    		'complain_type' => $request->jenis_komplain,
    		'notes' => $request->notes,
    		'attachment' => $request->lampiran,
            'status' => 1
    	];


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

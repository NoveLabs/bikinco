<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\Order;

use App\Http\Models\OrderLog;

use App\Http\Models\ComplainSO;

class OrderDikirimController extends Controller
{
	private $modelOrder;
	private $modelOrderLog;
    private $complainSO;

    public function __construct()
    {	
    	$this->modelOrder = new Order();
    	$this->modelOrderLog = new OrderLog();
        $this->complainSO = new ComplainSO();
    }

    public function index()
    {
    	$data = $this->modelOrder->getDataOrderSelesai();

        $dataLog = OrderLog::GetDataLogAll()->get();

    	return view('order-dikirim.index', compact('data', 'dataLog'));
    }

    public function indexKomplain()
    {
        $data = $this->modelOrder->getDataComplainSOC();

        // return $data;

        $count = count($data);

        return view('order-dikirim.komplain', compact('data', 'count'));
    }

    public function getComplain($id)
    {
        $data = $this->modelOrder->getSingleComplainSOC($id);
        
        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data Image Ditemukan',
        ], 200);
    }

    public function updateDone($id)
    {
        \DB::beginTransaction();
    	
    	$updateStatus = [
            'flow_step' => 10,
            'flow_step_date' => now(),
        ];

        $detail = $this->modelOrder->getDataOrderById($id);

        $detail->update($updateStatus);

        $inputLogOrder = [
            'order_id' => $id,
            'flow_step' => 10,
            'flow_step_date' =>now(),
        ];

        $createLogOrder = $this->modelOrderLog->create($inputLogOrder);
       
        \DB::commit();

        return response()->json([
            'status' => true,
            'data' => '',
            'message' => 'Order telah dikonfirmasi selesai'
            ], 200);


    }

    public function printPelunasan($id)
    {
        $data = $this->modelOrder->getDataInvoice($id);

        $hasil = $data->orderItems[0]->hasProduct->price * $data->total_item;

        return view('order-dikirim.nota-pelunasan', compact('data','hasil'));
    }


    public function addKomplain(Request $request)
    {
        \DB::beginTransaction();

        $input = [
            'complain_type' => $request->jenis_komplain,
            'notes' => $request->notes,
            'attachment' => $request->attachment,
            'order_id' => $request->order_id
        ];

        $save = $this->complainSO->create($input);

        \DB::commit();

        return response()->json([
            'status' => true,
            'data' => '',
            'message' => 'Komplain Berhasil Dikirim'
        ], 200);

    }

    public function getDataKirim()
    {
        $data = $this->modelOrder->getDataOrderSelesai();

        $counted = count($data);

        return $counted;
    }
    
}

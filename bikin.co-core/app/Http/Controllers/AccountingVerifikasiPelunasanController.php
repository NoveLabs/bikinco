<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;

use App\Http\Models\OrderPayment;

use App\Http\Models\OrderPaymentLog;

use App\Http\Models\Order;

use App\Http\Models\OrderLog;

use App\Http\Models\Customers;

use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;


class AccountingVerifikasiPelunasanController extends Controller
{
     private $modelOrderPayment;
     private $modelOrderPaymentLog;
     private $modelOrder;
     private $modelOrderLog;

    public function __construct()
    {
        $this->middleware('auth');
        $this->modelOrderPayment = new OrderPayment();
        $this->modelOrderPaymentLog = new OrderPaymentLog();
        $this->modelOrder = new Order();
        $this->modelOrderLog = new OrderLog();

    }

    public function index(Request $request)
    {
        $data = Order::GetDataPaymentsAccountingPelunasan()->get();

        $dataLog = OrderLog::GetDataLogAll()->get();

        $count = count($data);

        return view('accounting.accounting-verif-pelunasan', compact('data','count', 'dataLog'));
    }


    public function create(Request $request)
    {
        \DB::beginTransaction();

        $inputLog = 
        [
            'proof_payment' => $request->proof_payment,
            'status' => $request->status,
            'order_payment_id' => $request->id_order_payment,
            'type' => $request->type,
            'reason' => '',
            'is_dp' => '0',
            'payment_total' => $request->payment_total,
            'proof_payment_date' =>now(),
        ];

        $input = 
        [
            'proof_payment' => $request->proof_payment,
            'status' => $request->status,
            'order_id' => $request->order_id,
            'type' => $request->type,
            'is_dp' => '0',
            'payment_total' => $request->payment_total,
            'proof_payment_date' =>now(),
        ];

        $updateStatus = [
            'flow_step' => 9,
            'flow_step_date' => now(),
        ];
        $updateSt = $this->modelOrder->getDataOrderById($request->order_id);

        $updateSt->update($updateStatus);

        $inputLogOrder = [
        'order_id' => $request->order_id,
        'flow_step' => 9,
        'flow_step_date' => now()
       ];

        $createLogOrder = $this->modelOrderLog->create($inputLogOrder);
      
        
        $create = $this->modelOrderPaymentLog->create($inputLog);

        $detail = $this->modelOrderPayment->getSingleDataNonArray($request->order_id);


        $detail->update($input);

       \DB::commit();


        return redirect('/accounting_pelunasan');
    }

    public function tolak(Request $request)
    {
        \DB::beginTransaction();
        
        $input = 
        [
            'type' => $request->type,
            'status' => $request->status,
            'proof_payment' => $request->proof_payment,
            'order_id' => $request->id,
            'is_dp' => 1,
        ];

        $inputLog = 
        [
            'type' => $request->type,
            'status' => $request->status,
            'reason' => $request->keterangan,
            'proof_payment' => $request->proof_payment,
            'order_payment_id' => $request->order_id,
            'is_dp' => 1,
        ];

        $updateStatus = [
            'flow_step' => 7,
            'flow_step_date' =>now()
        ];
        $updateSt = $this->modelOrder->getDataOrderById($request->id);

        $updateSt->update($updateStatus);

         $inputLogOrder = [
        'order_id' => $request->id,
        'flow_step' => 7,
        'flow_step_date' => now()
        ];

        $createLogOrder = $this->modelOrderLog->create($inputLogOrder);


        $detail = $this->modelOrderPayment->getSingleDataNonArray($request->id);

        $detail->update($input);
        
        $create = $this->modelOrderPaymentLog->create($inputLog);

       \DB::commit();


        return redirect('/accounting_pelunasan');
    }


    public function show($id)
    {
        $data = $this->modelOrderPayment->getAllDataByIdAndTime_($id);
        
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Order Payment tidak ditemukan.'
            ], 403);
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data Order Payment ditemukan',
        ], 200);
    }

    public function showLog($id)
    {
        $data = $this->modelOrderPaymentLog->getAllDataByIdAndTime_($id);
        
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Order Payment tidak ditemukan.'
            ], 403);
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data Order Payment ditemukan',
        ], 200);
    }
    
    public function getDataVerifikasiPelunasan()
    {
        $DataByKonfirmasi = Order::GetDataPaymentsAccountingPelunasan()->get();

        $counted = count($DataByKonfirmasi);

        return $counted;
    }
}

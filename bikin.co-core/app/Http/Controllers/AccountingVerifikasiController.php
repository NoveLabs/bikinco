<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;

use App\Http\Models\OrderPayment;

use App\Http\Models\OrderPaymentLog;

use App\Http\Models\Order;

use App\Http\Models\OrderLog;

use App\Http\Models\Customers;

use App\Http\Models\ProductionStepMaster;

use App\Http\Models\OrderItemStep;

use App\Http\Models\VerifikasiArtwork;

use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;


class AccountingVerifikasiController extends Controller
{
    private $modelOrderPayment;
    private $modelOrderPaymentLog;
    private $modelProductionStepMaster;
    private $modelOrderItemStep;
    private $modelOrderLog;
    private $modelVerifikasiArtworkDesign;

    public function __construct()
    {
        $this->middleware('auth');
        $this->modelOrderPayment = new OrderPayment();
        $this->modelOrderPaymentLog = new OrderPaymentLog();
        $this->modelOrder = new Order();
        $this->modelProductionStepMaster = new ProductionStepMaster();
        $this->modelOrderItemStep = new OrderItemStep();
        $this->modelOrderLog = new OrderLog();
        $this->modelVerifikasiArtworkDesign = new VerifikasiArtwork();


    }

    public function index(Request $request)
    {
        $data = Order::GetDataPayments()->get();

        $dataLog = OrderLog::GetDataLogAll()->get();

        $count = count($data);

        return view('accounting.accounting-verif', compact('data','count', 'dataLog'));
    }


    public function create(Request $request)
    {
        \DB::beginTransaction();

        if ($request->type == 2) {
            $modifiedDate = now()->add(14, 'day')->format('Y-m-d H:i:s');

            $inputLog = 
            [
                'proof_payment' => $request->proof_payment,
                'status' => $request->status,
                'order_payment_id' => $request->id_order_payment,
                'type' => $request->type,
                'reason' => '',
                'is_dp' => '1',
                'payment_total' => $request->payment_total,
                'proof_payment_date' => now(),
                'due_date' => $modifiedDate
            ];

            $input = 
            [
                'proof_payment' => $request->proof_payment,
                'status' => $request->status,
                'order_id' => $request->order_id,
                'type' => $request->type,
                'is_dp' => '1',
                'payment_total' => $request->payment_total,
                'proof_payment_date' => now(),
                'due_date' => $modifiedDate,
            ];


        } else {

            $inputLog = 
            [
                'proof_payment' => $request->proof_payment,
                'status' => $request->status,
                'order_payment_id' => $request->id_order_payment,
                'type' => $request->type,
                'reason' => '',
                'is_dp' => '0',
                'payment_total' => $request->payment_total,
                'proof_payment_date' => now(),
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
        }

        $updateOrder = 
        [
            'flow_step' => 3,
            'flow_step_date' =>now(),
        ];

        $update = $this->modelOrder->getDataOrderById($request->order_id);

        $update->update($updateOrder);

        $inputLogOrder = [
        'order_id' => $request->order_id,
        'flow_step' => 3,
        'flow_step_date' => now()
       ];

       $createLogOrder = $this->modelOrderLog->create($inputLogOrder);

       $inputVerifikasiArtworkDesign = [
        'order_id' => $request->order_id,
        'status' => 3,
       ];   

       $createVerifikasiArtworkDesign = $this->modelVerifikasiArtworkDesign->create($inputVerifikasiArtworkDesign);


        $createStepMaster = $this->modelProductionStepMaster->getDataByProduct($request->order_id);

        foreach ($createStepMaster as $value) {
            $inputStep = [
                'step_title' => $value->step_title,
                'step_description' => $value->step_description,
                'order_item_id' => $value->id

            ];

            $create = $this->modelOrderItemStep->create($inputStep);

        }
        
        $create = $this->modelOrderPaymentLog->create($inputLog);

        $detail = $this->modelOrderPayment->getSingleDataNonArray($request->order_id);

        $detail->update($input);

       \DB::commit();

        return redirect('/accounting_verifikasi');
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
            'is_dp' => $request->is_dp,
        ];

        $inputLog = 
        [
            'type' => $request->type,
            'status' => $request->status,
            'reason' => $request->keterangan,
            'proof_payment' => $request->proof_payment,
            'order_payment_id' => $request->order_id,
            'is_dp' => $request->is_dp,
        ];

        $updateOrder = 
        [
            'flow_step' => 1,
            'flow_step_date' =>now(),
        ];

        $update = $this->modelOrder->getDataOrderById($request->id);

        $update->update($updateOrder);

        $inputLogOrder = [
        'order_id' => $request->id,
        'flow_step' => 1,
        'flow_step_date' => now()
       ];

       $createLogOrder = $this->modelOrderLog->create($inputLogOrder);



        $detail = $this->modelOrderPayment->getSingleDataNonArray($request->id);

        $detail->update($input);
        
        $create = $this->modelOrderPaymentLog->create($inputLog);

       \DB::commit();


        return redirect('/accounting_verifikasi');
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
        $data = $this->modelOrderPaymentLog->GetAllDataByIdAndTime_($id);
        
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

    public function getDataVerifikasi()
    {
        $DataByKonfirmasi = Order::GetDataPayments()->get();

        $counted = count($DataByKonfirmasi);
        
        return $counted;
    }
}

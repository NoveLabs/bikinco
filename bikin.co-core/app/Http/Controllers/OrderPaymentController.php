<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;

use App\Http\Models\OrderPaymentLog;

use App\Http\Models\OrderPayment;

use App\Http\Models\Order;

use App\Http\Models\OrderLog;

use App\Http\Models\Customers;

use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;

use Illuminate\Support\Str;

use Carbon\Carbon;

use File;

use App\Http\Helpers\UploadFile;


class OrderPaymentController extends Controller
{
    private $modelOrderPayment;
    private $modelOrderPaymentLog;
    private $modelOrder;

    public function __construct()
    {
        $this->middleware('auth');

        $this->modelOrderPaymentLog = new OrderPaymentLog();
        $this->modelOrderPayment = new OrderPayment();
        $this->modelOrder = new Order();
        $this->upload = new UploadFile();
        $this->modelOrderLog = new OrderLog();
    }

    public function index(Request $request)
    {
        $data = Order::GetDataPaymentsAll()->get();

        $dataLog = OrderLog::GetDataLogAll()->get();

        $count = count($data);

        return view('order-pay-confirmation.index', compact('data','count', 'dataLog'));
    }

 public function create(Request $request)
    {
        \DB::beginTransaction();

        $result =  OrderPayment::UpdateOrCreate([
            'order_id' => $request->id_order_payment
         ],
         [
            'status' => 3,
            'order_id' => $request->id_order_payment,
            'type' => $request->type,
            'is_dp' => '2',
            'payment_total' => $request->payment_total,
        ]);

        $dataUpload =  $this->upload->uploadOneFile($request->upload, 'awsfolderorderpayment', [
            [
                'height' => 320,
                'prefix' => '',
            ],
            [
                'height' => 160,
                'prefix' => 'sm_',
            ],
            [
                'height' => 80,
                'prefix' => 'xs_',
            ],
        ]);
        //update photo
        $result->update([
            "proof_payment"                 => $dataUpload['file_name'],
            "width"               => $dataUpload['width'],
            "height"              => $dataUpload['height'],
        ]);


        $updateStatus = [
            'flow_step' => 2,
            'flow_step_date' => now(),
        ];
        $data = $request->id_order_payment;

        $detail = $this->modelOrder->getDataOrderById($request->id_order_payment);
        $detail->update($updateStatus);

        $inputLogOrder = [
            'order_id' => $request->id_order_payment,
            'flow_step' => 2,
            'flow_step_date' => now()
        ];

        $createLogOrder = $this->modelOrderLog->create($inputLogOrder);


        $dataCreate = $this->modelOrderPayment->getSingleDataNonArray($request->id_order_payment);

        $inputLog = [
            'status' => 3,
            'order_payment_id' => $dataCreate->id,
            'type' => $request->type,
            'reason' => '',
            'is_dp' => '2',
            'payment_total' => $request->payment_total,
        ];

        $inputLog['proof_payment'] = $dataUpload['file_name'];


        $createLog = $this->modelOrderPaymentLog->create($inputLog);
        
        \DB::commit();


        return redirect('/order_payment');
    }


  public function show($id)
    {
        $data = $this->modelOrderPayment->GetSingleData($id)->first();

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

    public function showOrder($id)
    {
        $data = $this->modelOrderPayment->getDataOrder($id);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Order  tidak ditemukan.'
            ], 403);
        }


        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data Order ditemukan',
        ], 200);
    }

    public function getDataByKonfirmasi()
    {
        $DataByKonfirmasi = Order::GetDataPaymentsAll()->get();

        $counted = count($DataByKonfirmasi);
        
        return $counted;
    }   

    public function getStatusOrder($id)
    {
        $data = $this->modelOrderLog->getDataLogAllById($id);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Log Order  tidak ditemukan.'
            ], 403);
        }


        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data Log Order ditemukan',
        ], 200);
    }

    public function getAllStatusOrder($id)
    {
        $data = $this->modelOrderLog->getDataLogById($id);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Log Order  tidak ditemukan.'
            ], 403);
        }


        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data Log Order ditemukan',
        ], 200);
    }


    public function getOrderMaterials($id)
    {
        $data = $this->modelOrder->getDataOrderMaterial($id);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Order Material  tidak ditemukan.'
            ], 403);
        }


        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data  Order Material  ditemukan',
        ], 200);
    }
    
    public function getAdjustPrice($id)
    {
        $data = $this->modelOrder->getAdjustPrice($id);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Order Adjust Price  tidak ditemukan.'
            ], 403);
        }


        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data  Order Adjust Price  ditemukan',
        ], 200);
    }

    public function getItemSize($id)
    {
        $data = $this->modelOrder->getItemSize($id);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Order Item Size  tidak ditemukan.'
            ], 403);
        }


        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data  Order Item Size  ditemukan',
        ], 200);
    }

    public function getInfoDetail($id)
    {
        $data = $this->modelOrder->getInfoDetail($id);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data info detail order  tidak ditemukan.'
            ], 403);
        }


        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data  info detail order  ditemukan',
        ], 200);
    }

    public function getDesign($id)
    {
        $data = $this->modelOrder->getDesign($id);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data design order  tidak ditemukan.'
            ], 403);
        }


        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data  design order  ditemukan',
        ], 200);
    }

    public function getArtwork($id)
    {
        $data = $this->modelOrder->getArtwork($id);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Artwork tidak ditemukan.'
            ], 403);
        }


        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data Artwork ditemukan',
        ], 200);
    }

    public function getDesignReference($id)
    {
        $data = $this->modelOrder->getDesignReference($id);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Design Reference tidak ditemukan.'
            ], 403);
        }


        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data Design Reference ditemukan',
        ], 200);
    }

    // public function getMaterial($id)
    // {
    //     $data = $this->modelOrder->getMaterial($id);

    //     if (empty($data)) {
    //         return response()->json([
    //             'status' => false,
    //             'data' => [],
    //             'message' => 'Data Design Reference tidak ditemukan.'
    //         ], 403);
    //     }


    //     return response()->json([
    //         'status' => true,
    //         'data' => $data,
    //         'messsage' => 'Data Design Reference ditemukan',
    //     ], 200);
    // }

}

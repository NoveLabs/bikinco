<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;

use App\Http\Models\OrderPayment;

use App\Http\Models\OrderPaymentLog;

use App\Http\Models\Order;

use App\Http\Models\OrderLog;

use App\Http\Models\Customers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\File; 

use Illuminate\Support\Facades\Storage;

use App\Http\Helpers\UploadFile;


class OrderPaymentPelunasanController extends Controller
{
    private $modelOrderPayment;
    private $modelOrderPaymentLog;
    private $modelOrder;
    private $modelOrderLog;

    public function __construct()
    {
        $this->middleware('auth');

        $this->modelOrderPaymentLog = new OrderPaymentLog();
        $this->modelOrderPayment = new OrderPayment();
        $this->upload = new UploadFile();
        $this->modelOrder = new Order();
        $this->modelOrderLog = new OrderLog();
    }

    public function index(Request $request)
    {
        $data = Order::GetDataPaymentsPelunasan()->get();

        $dataLog = OrderLog::GetDataLogAll()->get();

        $count = count($data);

        return view('order-pay-pelunasan.index', compact('data','count', 'dataLog'));
    }

    public function create(Request $request)
    {
        \DB::beginTransaction();

        $input =  
            [
                'status' => 3,
                'order_id' => $request->id_order_payment,
                'type' => $request->type,
                'is_dp' => '1',
                'payment_total' => $request->payment_total,
            ];
        $dataCreate = $this->modelOrderPayment->getSingleDataNonArray($request->id_order_payment);

        $dataCreate->update($input);

        $dataUpload =  $this->upload->uploadOneFile($request->upload, 'awsfolderorderpelunasan', [
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
        $dataCreate->update([
            "proof_payment"       => $dataUpload['file_name'],
            "width"               => $dataUpload['width'],
            "height"              => $dataUpload['height'],
        ]);


        $updateStatus = [
            'flow_step' => 8,
            'flow_step_date' => now(),
        ];

        $detail = $this->modelOrder->getDataOrderById($request->id_order_payment);

        $detail->update($updateStatus);

        $inputLogOrder = [
            'order_id' => $request->id_order_payment,
            'flow_step' => 8,
            'flow_step_date' => now(),
        ];

        $createLogOrder = $this->modelOrderLog->create($inputLogOrder);

        $inputLog = 
        [
            'status' => 3,
            'order_payment_id' => $dataCreate->id,
            'type' => $request->type,
            'reason' => '',
            'is_dp' => '1',
            'payment_total' => $request->payment_total,
        ];

        $inputLog['proof_payment'] = $dataUpload['file_name'];

        $createLog = $this->modelOrderPaymentLog->create($inputLog);

        \DB::commit();


        return redirect('/order_pelunasan_payment');
    }

    
    public function show($id)
    {
        $data = $this->modelOrderPayment->getSingleData($id);
        
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

    public function getDataByKonfirmasiPelunasan()
    {
        $DataByKonfirmasi = Order::GetDataPaymentsPelunasan()->get();

        $counted = count($DataByKonfirmasi);
        
        return $counted;
    }

    public function printInvoice($id)
    {
        $data = $this->modelOrder->getDataInvoice($id);

        $hasil = $data->orderItems[0]->hasProduct->price * $data->total_item;

        return view('order-pay-pelunasan.invoice', compact('data','hasil'));
    }
}

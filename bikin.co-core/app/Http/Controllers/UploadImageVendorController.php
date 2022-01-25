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



class UploadImageVendorController extends Controller
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
        $data = Order::GetUploadImageVendor()->get();

        $dataLog = OrderLog::GetDataLogAll()->get();

        $count = count($data);

        return view('upload-image-vendor.index-dp', compact('data','count', 'dataLog'));
    }

    public function indexPelunasan(Request $request)
    {
        $data = Order::GetUploadImageVendorPelunasan()->get();

        $dataLog = OrderLog::GetDataLogAll()->get();

        $count = count($data);

        return view('upload-image-vendor.index-pelunasan', compact('data','count', 'dataLog'));
    }

 	public function create(Request $request)
    {
        \DB::beginTransaction();

        $result = OrderPayment::UpdateOrCreate([
                'order_id' => $request->id_order_payment
            ],
            [

            ]);
        $dataUpload =  $this->upload->uploadOneFile($request->upload, 'awsfoldervendordp', [
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
            "proof_payment_dp"       => $dataUpload['file_name'],
            "width"               => $dataUpload['width'],
            "height"              => $dataUpload['height'],
        ]);

        \DB::commit();


        return redirect('/vendor/upload/image');
    }

    public function createPelunasan(Request $request)
    {
        \DB::beginTransaction();


        $result = OrderPayment::UpdateOrCreate([
                'order_id' => $request->id_order_payment
            ],
            [
            ]);
        $dataUpload =  $this->upload->uploadOneFile($request->upload, 'awsfoldervendorpelunasan', [
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
            "proof_payment_pelunasan"       => $dataUpload['file_name'],
            "width"               => $dataUpload['width'],
            "height"              => $dataUpload['height'],
        ]);

        \DB::commit();

        return redirect('/vendor/upload/pelunasan');
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

}

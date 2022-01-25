<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Order;
use App\Http\Models\OrderItemStep;
use App\Http\Models\OrderItemStepImage;
use App\Http\Models\OrderItemStepNote;
use App\Http\Models\Categories;
use App\Http\Helpers\FormValidation;
use Illuminate\Support\Str;
use App\Http\Helpers\UploadFile;
use Illuminate\Support\Facades\Auth;

class VendorOrderProsesController extends Controller
{
    private $modelOrder;
	private $modelCategories;

	public function __construct()
    {
        $this->middleware('auth:vendor');
        $this->modelOrder = new Order();
        $this->modelCategories = new Categories();
        $this->modelOrderItemStep = new OrderItemStep();
        $this->modelOrderItemStepImage = new OrderItemStepImage();
        $this->upload = new UploadFile();
        $this->modelOrderItemStepNote = new OrderItemStepNote();
    }

    public function index()
    {	
        $id =  Auth::guard('vendor')->user()->id;

    	$data = $this->modelOrder->GetDataOrderProsesVendor($id);

        $count = count($data);

    	$product = $this->modelCategories->getDataCategories();

    	return view('vendor.order-diproses.index', compact('data','product', 'count'));
    }

    public function getImagePembayaran($id)
    {
        $data = $this->modelOrder->getImagePembayaran($id);

        return $data;
    }

    public function getImageVendorDP($id)
    {
        $data = $this->modelOrder->getImageVendorDP($id);

        return $data;
    }

    public function show(Request $request)
    {

        $dataStep0 = $this->modelOrderItemStep->getDataStep(0, $request->id);
        $dataStep1 = $this->modelOrderItemStep->getDataStep(1, $request->id);
        $dataStep2 = $this->modelOrderItemStep->getDataStep(2, $request->id);
        $dataStep3 = $this->modelOrderItemStep->getDataStep(3, $request->id);

        $data = $this->modelOrderItemStep->getDataById($request->id);
        $arr = [];
        foreach ($data as $value) {
            $status = $value->status;
            if($status == 3) {
                $arr[] = $status;
                } 
        }
        $complete_qty = count($arr);            
        $data_must_complete = count($data);

        if ($complete_qty === $data_must_complete) {
            $params = 1;
        } else {
            $params = 2;
        }

        return view('vendor.order-diproses.progress-track-order', compact('dataStep0', 'dataStep1', 'dataStep2', 'dataStep3', 'params'));
    }


    public function updateStep0(Request $request)
    {
        $id = $request->id;

        $input = [
            'status' => 1,
        ];
        
        $data = $this->modelOrderItemStep->getSingleData($id);

        $data->update($input);

        return back();
    }

    public function storeUpload(Request $request)
    {
        $imageUpload = new OrderItemStepImage();

        $imageUpload->order_item_step_id = $request->id;

        $imageUpload->save();

        $dataUpload =  $this->upload->uploadOneFile($request->file, 'awsfolderorderitemstep', [
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
        $imageUpload->update([
            "photo"               => $dataUpload['file_name'],
            "width"               => $dataUpload['width'],
            "height"              => $dataUpload['height'],
        ]);

        return response()->json(['success'=> $dataUpload['file_name']]);
    }

    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');

        OrderItemStepImage::where('photo',$filename)->delete();

        $path=public_path().'/'.$filename;

        if (file_exists($path)) {
            chmod($path, 0644);
                unlink($path);

        }

        return $filename;  
    }

    public function updateStep2(Request $request)
    {
        $id = $request->id;
        $input = [
            'status' => 2,
        ];

        $data = $this->modelOrderItemStep->getSingleData($id);

        $data->update($input);

        $inputNotes =
        [
            'order_item_step_id' => $id,
            'notes' => $request->notes,
            'created_by' => 0
        ];

        $create = $this->modelOrderItemStepNote->create($inputNotes);

        return back();
    }

    public function getLogImage($id)
    {
        $data = $this->modelOrderItemStepImage->GetAllDataImage($id);

        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data Image Ditemukan',
        ], 200);
    }

    public function getLogNote($id)
    {
        $data = $this->modelOrderItemStepNote->getAllDataNote($id);

        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => 'Data Note Ditemukan'
        ], 200);
    }

    public function getDataOrderProsesVendor()
    {
        $id =  Auth::guard('vendor')->user()->id;

        $data = $this->modelOrder->getDataOrderProsesVendor($id);

        $counted = count($data);

        return $counted;
    }
}

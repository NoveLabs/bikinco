<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Order;
use App\Http\Models\Categories;
use App\Http\Helpers\UploadFile;
use App\Http\Models\OrderItemFinishedImage;
use App\Http\Helpers\FormValidation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class VendorSelesaiProduksiController extends Controller
{
    private $modelOrder;
	private $modelCategories;
	private $modelOrderItemFinishedImage;

	public function __construct()
    {
        $this->middleware('auth');
        $this->modelOrder = new Order();
        $this->upload = new UploadFile();
        $this->modelCategories = new Categories();
        $this->modelOrderItemFinishedImage = new OrderItemFinishedImage();
    }

    public function index()
    {	
        $id =  Auth::guard('vendor')->user()->id;

    	$data = $this->modelOrder->GetDataOrderSelesaiProduksiVendor($id);

        $count = count($data);

    	$product = $this->modelCategories->getDataCategories();

    	return view('vendor.order-selesai-produksi.index', compact('data','product', 'count'));
    }

    public function create(Request $request)
    {   
        $imageUpload = $this->modelOrderItemFinishedImage;

        $imageUpload->order_item_id = $request->id;

        $imageUpload->save();

        $dataUpload =  $this->upload->uploadOneFile($request->file, 'awsfolderorderitemfinish', [
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
            "image"               => $dataUpload['file_name'],
            "width"               => $dataUpload['width'],
            "height"              => $dataUpload['height'],
        ]);

        return response()->json(['success'=>$dataUpload['file_name']]);
    }

    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');

        OrderItemFinishedImage::where('image',$filename)->delete();

        $path=public_path().'/'.$filename;

        if (file_exists($path)) {
            chmod($path, 0644);
                unlink($path);

        }

        return $filename;  
    }

    public function getLogImage($id)
    {
        $data = $this->modelOrderItemFinishedImage->GetAllDataImage($id);

        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data Image Ditemukan',
        ], 200);
    }


    public function getDataOrderSelesaiProduksiVendor()
    {
        $id =  Auth::guard('vendor')->user()->id;

        $data = $this->modelOrder->getDataOrderSelesaiProduksiVendor($id);

        $counted = count($data);
        
        return $counted;
    }
}

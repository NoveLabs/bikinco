<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;

use App\Http\Models\VerifikasiArtwork;

use App\Http\Models\ArtworkDesignLog;

use App\Http\Models\OrderItemArtwork;

use App\Http\Models\OrderItemCustArtwork;

use App\Http\Models\Order;

use App\Http\Models\OrderLog;

use App\Http\Models\Artwork;

use App\Http\Models\ArtworkSize;

use App\Http\Models\AtworkPrintType;

use App\Http\Models\AtworkPrintMethod;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\File; 

use App\Http\Helpers\UploadFile;

use Illuminate\Support\Facades\Storage;


class ProductDesignController extends Controller
{
    private $modelOrder;
    private $modelArtworkDesignLog;
    private $modelVerifikasiArtworkDesign;
    private $modelOrderItemArtwork;
    private $modelArtwork;
    private $modelArtworkSize;
    private $modelPrintType;
    private $modelPrintMethod;

    public function __construct()
    {
        $this->middleware('auth');
        $this->modelOrder = new Order();
        $this->modelArtworkDesignLog = new ArtworkDesignLog();
        $this->modelVerifikasiArtworkDesign = new VerifikasiArtwork();
        $this->modelOrderItemArtwork = new OrderItemArtwork();
        $this->modelArtwork = new Artwork();
        $this->modelArtworkSize = new ArtworkSize();
        $this->modelPrintType = new AtworkPrintType();
        $this->upload = new UploadFile();
        $this->modelPrintMethod = new AtworkPrintMethod();
    }

    public function index()
    {
    	$data = Order::GetDataArtworkDesignPD()->get();

        $dataLog = OrderLog::GetDataLogAll()->get();

        $count = count($data);
        
        return view('product-design-upload.index', compact('data', 'count', 'dataLog'));
    }

    public function show($id)
    {
        $dataArtwork = $this->modelOrder->GetDataArtworkById($id);
        $countArtwork = count($dataArtwork);

        $dataDesign = $this->modelOrder->GetDataDesignById($id);
        $countDesign = count($dataDesign);

        $dataOrder = $this->modelOrder->getDataOrder($id);
        $countOrder = count($dataOrder);

        $artworkSize = $this->modelArtworkSize->getAllData();

        $artworks = $this->modelArtwork->getAllData();

        $productMaterial = $this->modelPrintType->getAllData();

        $productCetak = $this->modelPrintMethod->getAllData();

        $dataLog = $this->modelOrder->getDataLog($id);

        return view('product-design-upload.detail-artwork-design', compact('dataArtwork', 'dataDesign', 'dataOrder', 'dataLog', 'countArtwork', 'countDesign', 'countOrder', 'artworkSize', 'artworks', 'productMaterial', 'productCetak'));
    }

    public function kirimRevisi(Request $request)
    {
    	$input = [
    		'order_id' => $request->order_id,
    		'role_id' => 4,
    		'reason' => $request->reason
    	];

    	$create = $this->modelArtworkDesignLog->create($input);

    	$update = [
    		'order_id' => $request->order_id,
    		'status' => 2
    	];

    	$detail = $this->modelVerifikasiArtworkDesign->getSingleData($request->order_id);

    	$detail->update($update);

    	return redirect('/pd_upload');
    }

    public function updateArtwork(Request $request)
    {
        $result = OrderItemArtwork::UpdateOrCreate([
            'id' => $request->id
         ],
         [
	        'id' => $request->id,
         	'order_item_id' => $request->order_id,
         	'artwork_size_id' => $request->ukuran,
            'artwork_position' => $request->artwork_posisi,
            'artwork_print_type_id' => $request->sablon,
         	'artwork_method_id' => $request->printing,
         	'color_qty' => $request->qty_color,
        ]);

        $dataUpload =  $this->upload->uploadOneFile($request->preview_artwork, 'awsfolderartwork', [
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
            "preview_image"                 => $dataUpload['file_name'],
            "width"               => $dataUpload['width'],
            "height"              => $dataUpload['height'],
        ]);

        $dataVector =  $this->upload->uploadFileWithoutImage($request->vector_artwork, 'awsfolderartwork');
        //update zip
        $result->update(['zip_file' => $dataVector['path_link']]);

        return back();
    }

    public function updateDesign(Request $request)
    {
        $result = OrderItemCustArtwork::UpdateOrCreate([
			'id' => $request->id
         ],
         [
         	'order_item_id' => $request->order_id,
         	'id' => $request->id,
         	'title' => $request->title,
        ]);

        $dataUpload =  $this->upload->uploadOneFile($request->upload, 'awsfolderdesign', [
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
            "photo"                 => $dataUpload['file_name'],
            "width"               => $dataUpload['width'],
            "height"              => $dataUpload['height'],
        ]);

        return back();
    }

    public function printPdf($id)
    {
        $dataArtwork = $this->modelOrder->getDataArtworkById($id);
        
        $dataArtworkSum = $this->modelOrder->getDataArtworkByIdSum($id);
        $countArtwork = count($dataArtwork);

        $dataDesign = $this->modelOrder->getDataDesignById($id);
        $countDesign = count($dataDesign);

        $dataOrder = $this->modelOrder->getDataOrder($id);
        $countOrder = count($dataOrder);

        $dataLog = $this->modelOrder->getDataLog($id);

        return view('product-design-upload.print', compact('dataArtwork', 'dataDesign', 'dataOrder', 'dataLog', 'countArtwork', 'countDesign', 'countOrder', 'dataArtworkSum'));
    }

    public function getFile($id)
    {
        $data = $this->modelOrderItemArtwork->getSingleData($id);
        if(is_file($data->zip_file)) {
            return response()->download(public_path($data->zip_file));
        } else {
            return redirect()->back();
        }
    }
}

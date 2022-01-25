<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\UploadFile;
use App\Http\Models\Order;
use App\Http\Models\Company;
use App\Http\Models\Banner;
use App\Http\Models\Testimoni;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;
use App\Http\Helpers\FormValidation;



class SuperadminController extends Controller
{
    private $modelOrder;
    private $modelCompany;
    private $modelBanner;
	private $modelTestimoni;
    
    public function __construct()
    {
        $this->middleware('auth');

    	$this->modelOrder = new Order();
        $this->modelCompany = new Company();
        $this->modelBanner = new Banner();
        $this->modelTestimoni = new Testimoni();
        $this->upload = new UploadFile();

    }

    public function banner(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->modelBanner->GetAllRecord()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('images', function($row){
                        return '<img src="'.$row->images.'" alt="gambar">'; 
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>
                        ';
                    })
                    ->rawColumns(['action', 'images'])
                    ->make(true);
        }

    	return view('superadmin.banner.index');
    }

    public function addBanner(Request $request)
    {
        $this->validate($request, [
                "banner" => "image|mimes:jpeg,png,jpg",
            ]
        ); 
        
        $input = Arr::only($request->all(), [
            'link',
            'status',
        ]);

        $result  = $this->modelBanner->create($input);

        if($request->banner != null) {

            $dataUpload =  $this->upload->uploadOneFile($request->banner, 'awsfolderbanner', [
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
                "images"                 => $dataUpload['file_name'],
                "width_image"               => $dataUpload['width'],
                "height_image"              => $dataUpload['height'],
            ]);
        }

        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data banner'
        ], 200);
    }

    public function updateBanner(Request $request, $id)
    {   
        $input = Arr::only($request->all(), [
            'link',
            'status',
        ]);
        
        $detail = $this->modelBanner->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data banner tidak ditemukan.'
            ], 403);
        }

        if($request->banner != 'undefined') {
            $dataUpload =  $this->upload->uploadOneFile($request->banner, 'awsfolderbanner', [
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
            $detail->update([
                "images"                 => $dataUpload['file_name'],
                "width_image"               => $dataUpload['width'],
                "height_image"              => $dataUpload['height'],
            ]);
        }
      

        $detail->update($input);
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data banner'
        ], 200);
    }

    public function showBanner($id)
    {
        $data = $this->modelBanner->getSingleRecord($id)->first();

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Banner tidak ditemukan.'
            ], 403);
        }

        return response()->json([
            'status' => true, 
            'data' => $data,
            'messsage' => 'Data Banner ditemukan',
        ], 200);
    }

    public function deleteBanner(Request $request)
    {
        $this->validate($request, [
                "id" => "required|numeric",
            ]
        ); 

        $input = $request->all();
        $detail = $this->modelBanner->getSingleData($request->id);
        $result = $detail->delete();

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data banner'
        ], 200);
    }

    public function testimoni(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->modelTestimoni->getAll();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('rating', function($row) {
                        $text = '"score"';
                        $rating = "<div data-sc-raty='{ ".$text.":".$row->rating." }' style='cursor: pointer;'>";

                        return $rating;
                    })
                    ->addColumn('action', function($row) {
                        if ($row->status == '1') {
                            return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>
                            <a href="#" class="sc-button sc-button-mini">SEMBUNYIKAN</a>
                        ';
                        } else {
                            return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>
                            <a style="margin-top: 5px;" id="sc-js-modal-confirm-done-order" class="sc-button sc-button-mini sc-button-success">TAMPILKAN</a>
                        ';
                        
                        }
                    })
                    ->rawColumns(['action', 'rating'])
                    ->make(true);
                    }

        $company = $this->modelCompany->getAll()->get();

        return view('superadmin.testimoni.index', compact('company'));
    }

    public function addTestimoni(Request $request)
    {
        $this->validate($request, [
                "company_id" => "required",
                "testimony" => "required",
                "rating" => "required",
            ]
        ); 
        
        $input = Arr::only($request->all(), [
            'company_id',
            'testimony',
            'rating'
        ]);


        $this->modelTestimoni->create($input);
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data testimoni'
        ], 200);
    }

    public function updateTestimoni(Request $request, $id)
    {   
        $input = Arr::only($request->all(), [
            'company_id',
            'testimony',
            'rating'
        ]);
        
        $detail = $this->modelTestimoni->getSingleData($id);

        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data testimoni tidak ditemukan.'
            ], 403);
        }

        $detail->update($input);
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data testimoni'
        ], 200);
    }

    public function showTestimoni($id)
    {
        $data = $this->modelTestimoni->getSingleData($id);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Company tidak ditemukan.'
            ], 403);
        }

        return response()->json([
            'status' => true, 
            'data' => $data,
            'messsage' => 'Data Company ditemukan',
        ], 200);
    }

    public function deleteTestimoni(Request $request)
    {
        $this->validate($request, [
                "id" => "required|numeric",
            ]
        ); 

        $input = $request->all();
        $detail = $this->modelTestimoni->getSingleData($request->id);
        $result = $detail->delete();

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data company'
        ], 200);
    }

    public function company(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->modelCompany->GetAllRecord()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('company_logo', function($row){
                        return '<img src="'.$row->company_logo.'" alt="gambar">'; 
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>
                        ';
                    })
                    ->rawColumns(['action', 'company_logo'])
                    ->make(true);
        }
        return view('superadmin.company.index');
    }

    public function addCompany(Request $request)
    {
        $this->validate($request, [
                "company_logo" => "image|mimes:jpeg,png,jpg",
                "company_name" => "required",
            ]
        ); 
        
        $input = Arr::only($request->all(), [
            'company_name',
        ]);

        $result = $this->modelCompany->create($input);

        if($request->company_logo != null) {        
           $dataUpload =  $this->upload->uploadOneFile($request->company_logo, 'awsfoldercompany', [
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
                "company_logo"                 => $dataUpload['file_name'],
                "width_logo"               => $dataUpload['width'],
                "height_logo"              => $dataUpload['height'],
            ]);
        }

        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data company'
        ], 200);
    }

    public function updateCompany(Request $request, $id)
    {   
        $input = Arr::only($request->all(), [
            'company_name'
        ]);
        
        $detail = $this->modelCompany->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data company tidak ditemukan.'
            ], 403);
        }

        $detail->update($input);

        if($request->company_logo != 'undefined') {

            $dataUpload =  $this->upload->uploadOneFile($request->company_logo, 'awsfoldercompany', [
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
                $detail->update([
                    "company_logo"                 => $dataUpload['file_name'],
                    "width_logo"               => $dataUpload['width'],
                    "height_logo"              => $dataUpload['height'],
                ]);
        }
        

        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data company'
        ], 200);
    }

    public function showCompany($id)
    {
        $data = $this->modelCompany->getSingleRecord($id)->first();

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Company tidak ditemukan.'
            ], 403);
        }

        return response()->json([
            'status' => true, 
            'data' => $data,
            'messsage' => 'Data Company ditemukan',
        ], 200);
    }

    public function companyAllData()
    {
        $data = $this->modelCompany->getAll()->get();

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Company tidak ditemukan.'
            ], 403);
        }

        return response()->json([
            'status' => true, 
            'data' => $data,
            'messsage' => 'Data Company ditemukan',
        ], 200);
    }

    public function deleteCompany(Request $request)
    {
        $this->validate($request, [
                "id" => "required|numeric",
            ]
        ); 

        $input = $request->all();
        $detail = $this->modelCompany->getSingleData($request->id);
        $result = $detail->delete();

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data company'
        ], 200);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\UploadFile;
use App\Http\Models\Promo;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;
use App\Http\Helpers\FormValidation;

class PromoController extends Controller
{
    private $modelPromo;
    
    public function __construct()
    {
        $this->middleware('auth');

        $this->modelPromo = new Promo();
        $this->upload = new UploadFile();

    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->modelPromo->GetAllRecord()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('image', function($row){
                        return '<img src="'.$row->image.'" alt="gambar">'; 
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>
                        ';
                    })
                    ->rawColumns(['action', 'image'])
                    ->make(true);
        }

    	return view('superadmin.promo.index');
    }

    public function addPromo(Request $request)
    {
        $this->validate($request, [
                "image_promo" => "image|mimes:jpeg,png,jpg",
            ]
        );

        $input = Arr::only($request->all(), [
            'title',
            'status',
            'description',
            'terms_condition',
            'period_start',
            'period_end',
            'coupon_code',
            'min_transactions'
        ]);

        $remove = str_replace(' ', '', $request->title);
        $slug = strtolower($remove).mt_rand(1000,9999);

        $input['slug'] = $slug;

         #upload to s3
        $result = $this->modelPromo->create($input);

          //if with photo uploader
        if(!empty($request->image_promo)){
            $dataUpload =  $this->upload->uploadOneFile($request->image_promo, 'awsfolderpromo', [
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
                "image"                 => $dataUpload['file_name'],
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

    public function updatePromo(Request $request, $id)
    {   
        $input = Arr::only($request->all(), [
            'title',
            'status',
            'description',
            'terms_condition',
            'period_start',
            'period_end',
            'coupon_code',
            'min_transactions'

        ]);
        $remove = str_replace(' ', '', $request->title);
        $slug = strtolower($remove).mt_rand(1000,9999);
        
        $input['slug'] = $slug;
        $detail = $this->modelPromo->GetSingleRecord($id)->first();
        
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data banner tidak ditemukan.'
            ], 403);
        }

        $detail->update($input);
        if($request->image != 'undefined') {
            $dataUpload =  $this->upload->uploadOneFile($request->image, 'awsfolderpromo', [
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
                "image"                 => $dataUpload['file_name'],
                "width_image"               => $dataUpload['width'],
                "height_image"              => $dataUpload['height'],
            ]);
        }
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data banner'
        ], 200);
    }

    public function showPromo($id)
    {
        $data = $this->modelPromo->getSingleRecord($id)->first();

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Promo tidak ditemukan.'
            ], 403);
        }

        return response()->json([
            'status' => true, 
            'data' => $data,
            'messsage' => 'Data Promo ditemukan',
        ], 200);
    }

    public function deletePromo(Request $request)
    {
        $this->validate($request, [
                "id" => "required|numeric",
            ]
        ); 

        $input = $request->all();
        $detail = $this->modelPromo->getSingleData($request->id);
        $result = $detail->delete();

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data banner'
        ], 200);
    }

}

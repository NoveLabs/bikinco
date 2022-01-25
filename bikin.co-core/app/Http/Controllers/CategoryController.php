<?php

namespace App\Http\Controllers;

use App\Http\Helpers\UploadFile;
use App\Http\Helpers\FormValidation;
use App\Http\Models\Category;
use App\Http\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    private $modelCategories;
    private $modelSubCategories;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->modelCategories = new Category();
        $this->modelSubCategories = new SubCategory();

        $this->upload = new UploadFile();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->modelCategories->getAllRecord()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editcolumn('status', function ($row) {
                        return $row->status == 1 ? '<span class="uk-label uk-label-success">Aktif</span>' : '<span class="uk-label uk-label-danger">Tidak Aktif</span>';
                    })
                    ->editcolumn('created_at', function ($row) {
                        return date('d/m/Y', strtotime($row->created_at));
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>
                           <button class="sc-button sc-button-success" onclick="window.location.href = \'' . route('product_step_master.single', $row->id) .'\';" type="button">Step Master</button>
                        ';
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
        }

        return view('product-development.category.category-list');
    }



    public function show($id)
    {
        $data = Category::GetSingleRecord($id)->first();

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data kategori tidak ditemukan.'
            ], 403);
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data kategori ditemukan',
        ], 200);
    }

    public function create(Request $request)
    {

        $this->validate($request, [
                "name" => "required",
                "status" => "numeric|in:0,1",
                "categories-file" => "image|mimes:jpeg,png,jpg",
                "categories-icon" => "image|mimes:jpeg,png",
            ]
        );

        $input = Arr::only($request->all(), [
            'name',
            'status',
            'categories-file',
            'categories-icon'
        ]);

        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                ],
                'message' => "Nama kategori '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('categories', $valid);
        if (!$check['status']) {
            return $check;
        }


        #upload to s3
       $result = $this->modelCategories->create($input);

          //if with photo uploader
        if(!empty($input['categories-file'])){
            $dataUpload =  $this->upload->uploadOneFile($input['categories-file'], 'awsfoldercategory', [
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
                "file_name"                 => $dataUpload['file_name'],
                "width_fname"               => $dataUpload['width'],
                "height_fname"              => $dataUpload['height'],
            ]);
        }

        if(!empty($input['categories-icon'])){
            $dataIcon =  $this->upload->uploadOneFile($input['categories-icon'], 'awsfoldercategoryicon', [
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
                "category_icon"                 => $dataIcon['file_name'],
                'width_icon'                    => $dataIcon['width'],
                'height_icon'                   => $dataIcon['height'],
            ]);
        }


        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data kategori'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                "name" => "required",
                "status" => "numeric|in:0,1",
            ]
        );

        $input = Arr::only($request->all(), [
            'name',
            'status',
            'detail-categories-file',
            'detail-categories-icon',
        ]);

        $detail = $this->modelCategories->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data kategori tidak ditemukan.'
            ], 403);
        }

                #upload to s3
        $detail->update($input);
        if($input['detail-categories-file'] != 'undefined') {

              //if with photo uploader
            if(!empty($input['detail-categories-file'])){
                $dataUpload =  $this->upload->uploadOneFile($input['detail-categories-file'], 'awsfoldercategory', [
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
                    "file_name"                 => $dataUpload['file_name'],
                    "width_fname"               => $dataUpload['width'],
                    "height_fname"              => $dataUpload['height'],
                ]);
            }
        }

        if($input['detail-categories-icon'] != 'undefined') {

            if(!empty($input['detail-categories-icon'])){
                $dataIcon =  $this->upload->uploadOneFile($input['detail-categories-icon'], 'awsfoldercategoryicon', [
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
                    "category_icon"                 => $dataIcon['file_name'],
                    'width_icon'                    => $dataIcon['width'],
                    'height_icon'                   => $dataIcon['height'],
                ]);
            }
        }


        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data kategori'
        ], 200);
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
                "id" => "required|numeric",
            ]
        );

        $input = $request->all();
        $detail = $this->modelCategories->getSingleData($input['id']);

        $checkOnSub = $this->modelSubCategories->checkTotalCategoriesOnSub($input['id']);
        if ($checkOnSub > 0) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => "Data kategori {$detail->name} masih digunakan.",
            ], 403);
        }

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data kategori'
        ], 200);
    }
}

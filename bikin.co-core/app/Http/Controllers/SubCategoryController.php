<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;
use App\Http\Helpers\FormValidation2;
use App\Http\Models\Category;
use App\Http\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Helpers\UploadFile;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
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
        $this->upload = new UploadFile();
        $this->modelSubCategories = new SubCategory();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SubCategory::with('hasCategories')->whereNull('deleted_at');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editcolumn('status', function ($row) {
                        return $row->status == 1 ? '<span class="uk-label uk-label-success">Aktif</span>' : '<span class="uk-label uk-label-danger">Tidak Aktif</span>';
                    })
                    ->editcolumn('created_at', function ($row) {
                        return date('d/m/Y', strtotime($row->created_at));
                    })
                    ->addColumn('alias_categories', function ($row) {
                        return !empty($row->hasCategories->name) ? $row->hasCategories->name : '' ;
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>';
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
        }

        $categories = $this->modelCategories->getAllData();

        return view('product-development.category.sub-category-list', compact('categories'));
    }

    public function show($id)
    {
        $data = $this->modelSubCategories->GetSingleRecord($id)->first();

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data sub-kategori tidak ditemukan'
            ], 403);
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data sub-kategori ditemukan',
        ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
                "name" => "required",
                "categories_id" => "required|numeric",
                "status" => "numeric|in:0,1",
                "file_name" => "image|mimes:jpeg,png,jpg",
            ]
        );

        $input = Arr::only($request->all(), [
            'name',
            'categories_id',
            'status',
        ]);

        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                    ['name' => 'categories_id', 'opr' => '=', 'value' => $input['categories_id'], 'opr_func' => 'where'],
                ],
                'message' => "Nama sub-kategori '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('sub_categories', $valid);
        if (!$check['status']) {
            return $check;
        }
        $result = $this->modelSubCategories->create($input);

        $dataUpload =  $this->upload->uploadOneFile($request->file('file_name'), 'awsfoldersubcategories', [
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
            "file_name"           => $dataUpload['file_name'],
            "width"               => $dataUpload['width'],
            "height"              => $dataUpload['height'],
        ]);

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data sub-kategori'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                "name" => "required",
                "categories_id" => "required|numeric",
                "status" => "numeric|in:0,1",
            ]
        );

        $input = Arr::only($request->all(), [
            'name',
            'categories_id',
            'status',
        ]);

        $detail = $this->modelSubCategories->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data sub-kategori tidak ditemukan.'
            ], 403);
        }

        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                    ['name' => 'categories_id', 'opr' => '=', 'value' => $input['categories_id'], 'opr_func' => 'where'],
                ],
                'message' => "Nama sub-kategori '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('sub_categories', $valid, $detail->id);
        if (!$check['status']) {
            return $check;
        }

        $detail->update($input);

        if($request->file_name != 'undefined') {

        $dataUpload =  $this->upload->uploadOneFile($request->file('file_name'), 'awsfoldersubcategories', [
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
            "file_name"           => $dataUpload['file_name'],
            "width"               => $dataUpload['width'],
            "height"              => $dataUpload['height'],
        ]);
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui sub-kategori'
        ], 200);
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
                "id" => "required|numeric",
            ]
        );

        $input = $request->all();

        $detail = $this->modelSubCategories->getSingleData($input['id']);

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data sub-kategori'
        ], 200);
    }
}

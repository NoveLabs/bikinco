<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;
use App\Http\Models\ProductSpecification;
use App\Http\Models\ProductSpecificationItem;
use App\Http\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class ProductSpecificationController extends Controller
{
    private $modelProductSpecification;
    private $modelProductSpecificationItem;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->modelProductSpecification = new ProductSpecification();
        $this->modelProductSpecificationItem = new ProductSpecificationItem();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductSpecification::with('hasItem')->with('hasSubcategory')->whereNull('deleted_at');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editcolumn('status', function ($row) {
                        return $row->status == 1 ? '<span class="uk-label uk-label-success">Aktif</span>' : '<span class="uk-label uk-label-danger">Tidak Aktif</span>';
                    })
                ->editColumn('alias_subcategory', function ($row) {
                    return !empty($row->hasSubcategory->name) ? $row->hasSubcategory->name : '-';
                })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>';
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
        }

        $subcategories = SubCategory::all();

        $compact = [
            'subcategories' => $subcategories,
        ];

        return view('product-development.product.product-specification-list')->with($compact);
    }

    public function show($id)
    {
        $data = $this->modelProductSpecification->getSingleData($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data spesifikasi produk tidak ditemukan'
            ], 406);
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data spesifikasi produk ditemukan',
        ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
                "name" => "required",
                "status" => "numeric|in:0,1",
                "subcategory_id" => "required|numeric",
            ]
        );

        $input = Arr::only($request->all(), [
            'name',
            'status',
            'subcategory_id'
        ]);

        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                ],
                'message' => "Nama spesifikasi produk '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('product_specifications', $valid);
        if (!$check['status']) {
            return $check;
        }

        $create = $this->modelProductSpecification->create($input);
        if (!$create) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Gagal menambahkan data spesifikasi produk'
            ], 200);
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data spesifikasi produk'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                "name" => "required",
                "status" => "numeric|in:0,1",
                "subcategory_id" => "required|numeric",
            ]
        );

        $input = Arr::only($request->all(), [
            'name',
            'status',
            'subcategory_id',
        ]);

        $detail = $this->modelProductSpecification->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data spesifikasi produk tidak ditemukan'
            ], 406);
        }

        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                ],
                'message' => "Nama spesifikasi produk '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('product_specifications', $valid, $detail->id);
        if (!$check['status']) {
            return $check;
        }

        $detail->update($input);

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data spesifikasi produk'
        ], 200);
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
                "id" => "required|numeric",
            ]
        );

        $input = Arr::only($request->all(), [
            'id',
        ]);

        $detail = $this->modelProductSpecification->getSingleData($input['id']);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data spesifikasi produk tidak ditemukan'
            ], 406);
        }

        $checkOnItems = $this->modelProductSpecificationItem->getTotalDataBySpecification($input['id']);
        if ($checkOnItems > 0) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data spesifikasi produk masih digunakan'
            ], 406);
        }

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data spesifikasi produk'
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;
use App\Http\Models\ProductHasSpecificationItem;
use App\Http\Models\ProductSpecification;
use App\Http\Models\ProductSpecificationItem;
use App\Services\SubcategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ProductSpecificationItemController extends Controller
{
    private $modelProductSpecification;
    private $modelProductSpecificationItem;
    private $modelProductHasSpecification;
    private $modelSubcategory;

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
        $this->modelProductHasSpecification =  new ProductHasSpecificationItem();
        $this->modelSubcategory = new SubcategoryService();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductSpecificationItem::with('hasSpecification')->whereNull('deleted_at');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editcolumn('status', function ($row) {
                        return $row->status == 1 ? '<span class="uk-label uk-label-success">Aktif</span>' : '<span class="uk-label uk-label-danger">Tidak Aktif</span>';
                    })
                    ->addColumn('alias_specification', function($row) {
                        return !empty($row->hasSpecification->name) ? $row->hasSpecification->name : '' ;
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>';
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
        }

        $specifications = $this->modelProductSpecification->getAllData();

        $subcategory = [];
        foreach ($specifications as $specification) {
            $data = $this->modelSubcategory->filterSubcatsWhere('id', $specification->subcategory_id);
            array_push($subcategory, $data);
        }

        return view('product-development.product.product-specification-item-list',
                    compact(
                        'specifications', 'subcategory'
                    ));
    }

    public function show($id)
    {
        $data = $this->modelProductSpecificationItem->getSingleData($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data spesifikasi item dari produk tidak ditemukan'
            ], 406);
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data spesifikasi item dari produk ditemukan',
        ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
                "name" => "required",
                "product_specification_id" => "required|numeric",
                "price" => "required",
                "status" => "numeric|in:0,1",
            ]
        );

        $input = Arr::only($request->all(), [
            'name',
            'product_specification_id',
            'status',
            'price',
        ]);

        # Change Price String to number Only
        $data_price = explode(',', $request->price);
        $input['price'] = implode('', $data_price);

        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                    ['name' => 'product_specification_id', 'opr' => '=', 'value' => $input['product_specification_id'], 'opr_func' => 'where'],
                ],
                'message' => "Nama tipe spesifikasi produk '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('product_specification_items', $valid);
        if (!$check['status']) {
            return $check;
        }

        $create = $this->modelProductSpecificationItem->create($input);
        if (!$create) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Gagal menambahkan data spesifikasi item dari produk'
            ], 200);
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data spesifikasi item dari produk'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                "name" => "required",
                "product_specification_id" => "required|numeric",
                "price" => "required",
                "status" => "numeric|in:0,1",
            ]
        );

        $input = Arr::only($request->all(), [
            'name',
            'product_specification_id',
            'status',
            'price',
        ]);

        # Change Price String to number Only
        $data_price = explode(',', $request->price);
        $input['price'] = implode('', $data_price);

        $detail = $this->modelProductSpecificationItem->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data spesifikasi item dari produk tidak ditemukan'
            ], 406);
        }

        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                    ['name' => 'product_specification_id', 'opr' => '=', 'value' => $input['product_specification_id'], 'opr_func' => 'where'],
                ],
                'message' => "Nama tipe spesifikasi produk '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('product_specification_items', $valid, $detail->id);
        if (!$check['status']) {
            return $check;
        }

        $detail->update($input);

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data spesifikasi item dari produk'
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

        $detail = $this->modelProductSpecificationItem->getSingleData($input['id']);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data spesifikasi item dari produk tidak ditemukan'
            ], 406);
        }

        $checkOnItems = $this->modelProductHasSpecification->getTotalDataBySpecification($input['id']);
        if ($checkOnItems > 0) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data spesifikasi item dari produk masih digunakan'
            ], 406);
        }

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data spesifikasi item dari produk'
        ], 200);
    }
}

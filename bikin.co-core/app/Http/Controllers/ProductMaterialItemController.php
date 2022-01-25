<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;
use App\Http\Models\ProductMaterial;
use App\Http\Models\ProductMaterialItem;
use App\Http\Models\ProductMaterialStock;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class ProductMaterialItemController extends Controller
{
    private $modelProductMaterial;
    private $modelProductMaterialItem;
    private $modelProductMaterialStock;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->modelProductMaterial = new ProductMaterial();
        $this->modelProductMaterialItem = new ProductMaterialItem();
        $this->modelProductMaterialStock = new ProductMaterialStock();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductMaterialItem::with('hasProductMaterial')->whereNull('deleted_at');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editcolumn('status', function ($row) {
                        return $row->status == 1 ? '<span class="uk-label uk-label-success">Aktif</span>' : '<span class="uk-label uk-label-danger">Tidak Aktif</span>';
                    })
                    ->addColumn('alias_material', function ($row) {
                        return !empty($row->hasProductMaterial->name) ? $row->hasProductMaterial->name : '' ;
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>';
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
        }

        $materials = $this->modelProductMaterial->getAllData();

        return view('product-development.product-material.product-material-item-list', compact('materials'));
    }

    public function show($id)
    {
        $data = $this->modelProductMaterialItem->getSingleData($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data material item dari produk tidak ditemukan'
            ], 406);
        }

        return response()->json([
            'status' => true, 
            'data' => $data,
            'messsage' => 'Data material item dari produk ditemukan',
        ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
                "name" => "required",
                "product_material_id" => "required|numeric",
                "status" => "numeric|in:0,1",
            ]
        );
        
        $input = Arr::only($request->all(), [
            'name',
            'product_material_id',
            'status'
        ]);
        
        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                    ['name' => 'product_material_id', 'opr' => '=', 'value' => $input['product_material_id'], 'opr_func' => 'where'],
                ],
                'message' => "Nama tipe material '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('product_material_items', $valid);
        if (!$check['status']) {
            return response()->json($check, 406);
        }

        $create = $this->modelProductMaterialItem->create($input);
        if (!$create) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Gagal menambahkan data material item dari produk'
            ], 200);
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data material item dari produk'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                "name" => "required",
                "product_material_id" => "required|numeric",
                "status" => "numeric|in:0,1",
            ]
        ); 
        
        $input = Arr::only($request->all(), [
            'name',
            'product_material_id',
            'status'
        ]);
        
        $detail = $this->modelProductMaterialItem->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data material item dari produk tidak ditemukan'
            ], 406);
        }
        
        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                    ['name' => 'product_material_id', 'opr' => '=', 'value' => $input['product_material_id'], 'opr_func' => 'where'],
                ],
                'message' => "Nama tipe material '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('product_material_items', $valid, $detail->id);
        if (!$check['status']) {
            return response()->json($check, 406);
        }

        $detail->update($input);
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data material item dari produk'
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

        $detail = $this->modelProductMaterialItem->getSingleData($input['id']);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data material item dari produk tidak ditemukan'
            ], 406);
        }

        $checkOnMaterialStock = $this->modelProductMaterialStock->getTotalDataByMaterialItem($input['id']);
        if ($checkOnMaterialStock > 0) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data material item dari produk masih digunakan'
            ], 406);
        }

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data material item dari produk'
        ], 200);
    }
}

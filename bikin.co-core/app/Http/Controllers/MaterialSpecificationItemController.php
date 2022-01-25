<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;
use App\Http\Models\MaterialSpecification;
use App\Http\Models\MaterialSpecificationItem;
use App\Http\Models\MaterialStockHasSpecificationItem;
use App\Services\ProductService as Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class MaterialSpecificationItemController extends Controller
{
    private $modelMaterialSpecification;
    private $modelMaterialSpecificationItem;
    private $modelMaterialStockHasItem;
    private $modelProductMaterialItem;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->modelMaterialSpecification = new MaterialSpecification();
        $this->modelMaterialSpecificationItem = new MaterialSpecificationItem();
        $this->modelMaterialStockHasItem = new MaterialStockHasSpecificationItem();
        $this->modelProductMaterialItem = new Product();
    }

    public function index(Request $request)
    {
//        $data = MaterialSpecificationItem::with('hasSpecification')->with('hasProductMaterialItem')->whereNull('deleted_at');
//        $data = MaterialSpecificationItem::with('hasSpecification')->whereNull('deleted_at');
//        dd($data->get());
        if ($request->ajax()) {
            $data = MaterialSpecificationItem::with('hasSpecification')->with('hasProductMaterialItem')->whereNull('deleted_at');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editcolumn('status', function ($row) {
                        return $row->status == 1 ? '<span class="uk-label uk-label-success">Aktif</span>' : '<span class="uk-label uk-label-danger">Tidak Aktif</span>';
                    })
                    ->addColumn('alias_specification', function ($row) {
                        return !empty($row->hasSpecification->name) ? $row->hasSpecification->name : '' ;
                    })
                ->editColumn('alias_material_item', function ($row) {
                    return !empty($row->hasProductMaterialItem->name) ? $row->hasProductMaterialItem->name : '';
                })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>';
                    })
                ->rawColumns(['status', 'action', 'alias_material_item'])
                    ->make(true);
        }

        $specifications = $this->modelMaterialSpecification->getAllData();
        $material_item = $this->modelProductMaterialItem->getAllProductMaterialItems();

        $compact = [
            'specifications' => $specifications,
            'material_items' => $material_item,
        ];

        return view('product-development.product-material.specification-item-list')->with($compact);
    }

    public function show($id)
    {
        $data = $this->modelMaterialSpecificationItem->getSingleData($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data spesifikasi item tidak ditemukan'
            ], 406);
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data spesifikasi item ditemukan',
        ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
                "name" => "required",
                "material_specification_id" => "required|numeric",
                'material_item_id' => 'required|numeric',
                "status" => "numeric|in:0,1",
            ]
        );

        $input = Arr::only($request->all(), [
            'name',
            'material_specification_id',
            'material_item_id',
            'status'
        ]);

        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                    ['name' => 'material_specification_id', 'opr' => '=', 'value' => $input['material_specification_id'], 'opr_func' => 'where'],
                ],
                'message' => "Nama tipe spesifikasi '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('material_specification_items', $valid);
        if (!$check['status']) {
            return $check;
        }

        $create = $this->modelMaterialSpecificationItem->create($input);
        if (!$create) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Gagal menambahkan data spesifikasi item'
            ], 200);
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data spesifikasi item'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                "name" => "required",
                "material_specification_id" => "required|numeric",
                'material_item_id' => 'required|numeric',
                "status" => "numeric|in:0,1",
            ]
        );

        $input = Arr::only($request->all(), [
            'name',
            'material_specification_id',
            'material_item_id',
            'status'
        ]);

        $detail = $this->modelMaterialSpecificationItem->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data spesifikasi item tidak ditemukan'
            ], 406);
        }

        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                    ['name' => 'material_specification_id', 'opr' => '=', 'value' => $input['material_specification_id'], 'opr_func' => 'where'],
                ],
                'message' => "Nama tipe spesifikasi '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('material_specification_items', $valid, $detail->id);
        if (!$check['status']) {
            return $check;
        }

        $detail->update($input);

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data spesifikasi item'
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

        $detail = $this->modelMaterialSpecificationItem->getSingleData($input['id']);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data spesifikasi item tidak ditemukan'
            ], 406);
        }

        $checkOnMaterialStock = $this->modelMaterialStockHasItem->getTotalDataBySpecificiationItem($input['id']);
        if ($checkOnMaterialStock > 0) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data spesifikasi item masih digunakan'
            ], 406);
        }

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data spesifikasi item'
        ], 200);
    }

    public function getMaterialItem($id)
    {
        $materialItem = $this->modelProductMaterialItem->filterProductMaterialItemsWhere('id', $id);

        $response = [
            'status' => true,
            'code' => 200,
            'data' => $materialItem,
            'message' => 'OK',
        ];
        return response()->json($response);
    }
}

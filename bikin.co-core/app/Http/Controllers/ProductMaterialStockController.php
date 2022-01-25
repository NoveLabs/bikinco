<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;
use App\Http\Models\MaterialSpecificationItem;
use App\Http\Models\MaterialStockHasSpecificationItem;
use App\Http\Models\ProductHasMaterialStock;
use App\Http\Models\ProductMaterialItem;
use App\Http\Models\ProductMaterialStock;
use App\Http\Models\Supplier;
use App\Http\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class ProductMaterialStockController extends Controller
{
    private $modelSupplier;
    private $modelMaterialItem;
    private $modelUnit;
    private $modelSpecificationItem;
    private $modelProductMaterialStock;
    private $modelProductHasMaterialStock;
    private $modelMaterialStockHasSpecification;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->modelSupplier = new Supplier();
        $this->modelMaterialItem = new ProductMaterialItem();
        $this->modelUnit = new Unit();
        $this->modelSpecificationItem = new MaterialSpecificationItem();
        $this->modelProductMaterialStock = new ProductMaterialStock();
        $this->modelProductHasMaterialStock = new ProductHasMaterialStock();
        $this->modelMaterialStockHasSpecification = new MaterialStockHasSpecificationItem();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductMaterialStock::with('hasMaterialItem')
                                ->with('hasSupplier')
                                ->with('hasUnit')
                                ->with('hasSpecificationItems.hasSpecificationItem')
                                ->with('hasMaterialItem.hasProductMaterial')
                                ->whereNull('deleted_at');

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editcolumn('created_at', function ($row) {
                        return date('d/m/Y', strtotime($row->created_at));
                    })
                    ->addColumn('alias_supplier', function ($row) {
                        return !empty($row->hasSupplier->company_name) ? $row->hasSupplier->company_name : '' ;
                    })
                    ->addColumn('alias_unit', function ($row) {
                        return !empty($row->hasUnit->name) ? $row->hasUnit->name : '' ;
                    })
                    ->addColumn('alias_material_item', function ($row) {
                        return !empty($row->hasMaterialItem->name) ? $row->hasMaterialItem->hasProductMaterial->name.' - '.$row->hasMaterialItem->name : '' ;
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>';
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
        }

        $suppliers = $this->modelSupplier->getAllData();
        $materialItems = $this->modelMaterialItem->getAllData();
        $units = $this->modelUnit->getAllData();
        $specificationItems = $this->modelSpecificationItem->getAllData();

        return view('product-development.product-material.product-material-stock-list',
                compact(
                    'suppliers',
                    'materialItems',
                    'units',
                    'specificationItems'
                ));
    }

    public function show($id)
    {
        $data = $this->modelProductMaterialStock->getSingleData($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data stok material tidak ditemukan'
            ], 406);
        }

        $specificationItems = [];
        if (!empty($data->hasSpecificationItems()->get())) {
            foreach ($data->hasSpecificationItems()->get() as $item) {
                $specificationItems[] = $item->hasSpecificationItem->id;
            }
        }

        $data['sitem'] = $specificationItems;

        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data stok material ditemukan',
        ], 200);
    }

    public function materialUnit($id)
    {
        $data = $this->modelProductMaterialStock->getSingleData($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data material unit tidak ditemukan'
            ], 406);
        }

        $unit = !empty($data->hasUnit->name) ? $data->hasUnit->name : '' ;

        return response()->json([
            'status' => true,
            'data' => $unit,
            'messsage' => 'Data material unit ditemukan',
        ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
                "supplier_id" => "required|numeric",
                "material_item_id" => "required|numeric",
                "initial_stock" => "required|numeric",
                "unit_id" => "required|numeric",
                "specification_items" => "required",
                "specification_items.*" => "required_with:specification_items|numeric",
            ]
        );

        $input = Arr::only($request->all(), [
            'supplier_id',
            'material_item_id',
            'initial_stock',
            'unit_id',
            'note',
            'specification_items'
        ]);

        $input['hold_on_stock'] = $input['initial_stock'];

        $material = $this->modelMaterialItem->getSingleData($input['material_item_id']);
        $supplier = $this->modelSupplier->getSingleData($input['supplier_id']);
        $valid = [
            [
                'condition' => [
                    ['name' => 'supplier_id', 'opr' => '=', 'value' => $input['supplier_id'], 'opr_func' => 'where'],
                    ['name' => 'material_item_id', 'opr' => '=', 'value' => $input['material_item_id'], 'opr_func' => 'where'],
                ],
                'message' => "Material '{$material->name}' dari suplier '{$supplier->company_name}' sudah ditambahkan, anda dapat menambahkan stok saja.",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('product_material_stocks', $valid);
        if (!$check['status']) {
            return response()->json($check, 406);
        }

        $create = $this->modelProductMaterialStock->create($input);
        if (!$create) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Gagal menambahkan data stok material'
            ], 200);
        }

        if (!empty($input['specification_items'])) {
            foreach ($input['specification_items'] as $item) {
                $checkItem = $this->modelSpecificationItem->getSingleData($item);

                if (!empty($checkItem)) {
                    $this->modelMaterialStockHasSpecification->create([
                        'material_stock_id' => $create->id,
                        'specification_item_id' => $item,
                    ]);
                }
            }
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data stok material'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                "supplier_id" => "required|numeric",
                "material_item_id" => "required|numeric",
                "unit_id" => "required|numeric",
                "specification_items" => "required",
                "specification_items.*" => "required_with:specification_items|numeric",
            ]
        );

        $input = Arr::only($request->all(), [
            'supplier_id',
            'material_item_id',
            'unit_id',
            'note',
            'specification_items'
        ]);

        $detail = $this->modelProductMaterialStock->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data stok material tidak ditemukan'
            ], 406);
        }

        $material = $this->modelMaterialItem->getSingleData($input['material_item_id']);
        $supplier = $this->modelSupplier->getSingleData($input['supplier_id']);
        //        $valid = [
        //            [
        //                'condition' => [
        //                    ['name' => 'supplier_id', 'opr' => '=', 'value' => $input['supplier_id'], 'opr_func' => 'where'],
        //                    ['name' => 'material_item_id', 'opr' => '=', 'value' => $input['material_item_id'], 'opr_func' => 'where'],
        //                ],
        //                'message' => "Material '{$material->name}' dari suplier '{$supplier->company_name}' sudah ditambahkan, anda dapat menambahkan stok saja.",
        //            ]
        //        ];
        //
        //        $check = FormValidation::uniqueColumnValidation('product_material_stocks', $valid);
        //        if (!$check['status']) {
        //            return response()->json($check, 406);
        //        }

        $detail->update($input);

        if (!empty($input['specification_items'])) {
            $detail->hasSpecificationItems()->delete();

            foreach ($input['specification_items'] as $item) {
                $checkItem = $this->modelSpecificationItem->getSingleData($item);

                if (!empty($checkItem)) {
                    $this->modelMaterialStockHasSpecification->create([
                        'material_stock_id' => $detail->id,
                        'specification_item_id' => $item,
                    ]);
                }
            }
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data stok material'
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

        $detail = $this->modelProductMaterialStock->getSingleData($input['id']);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data stok material tidak ditemukan'
            ], 406);
        }

        $checkOnProductStock = $this->modelProductHasMaterialStock->getTotalDataByMaterialStock($input['id']);
        if ($checkOnProductStock > 0) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data stok material masih digunakan'
            ], 406);
        }

        $detail->hasSpecificationItems()->delete();

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data stok material'
        ], 200);
    }
}

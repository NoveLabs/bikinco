<?php

namespace App\Http\Controllers;

use App\Http\Models\Product;
use App\Http\Models\ProductHasMaterialStock;
use App\Http\Models\ProductImage;
use App\Http\Models\ProductMaterialStock;
use App\Http\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class ProductHasMaterialStockController extends Controller
{
    private $modelProduct;
    private $modelProductImage;
    private $modelMaterialStock;
    private $modelUnit;
    private $modelProductHasMaterialStock;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->modelProduct = new Product();
        $this->modelProductImage = new ProductImage();
        $this->modelMaterialStock = new ProductMaterialStock();
        $this->modelUnit = new Unit();
        $this->modelProductHasMaterialStock = new ProductHasMaterialStock();
    }

    public function index(Request $request, $productId)
    {
        $product = $this->modelProduct->getSingleData($productId);

        if (empty($product)) {
            return redirect()->route('products');
        }

        if ($request->ajax()) {
            $data = ProductHasMaterialStock::with('hasMaterialStock.hasMaterialItem')
                                ->with('hasMaterialStock.hasSupplier')
                                ->with('hasMaterialStock.hasUnit')
                                ->with('hasProduct')
                                ->with('hasMaterialStock.hasMaterialItem.hasProductMaterial')
                                ->where('product_id', $productId)
                                ->whereNull('deleted_at');

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editcolumn('created_at', function ($row) {
                        return date('d/m/Y', strtotime($row->created_at));
                    })
                    ->addColumn('alias_product', function ($row) {
                        return !empty($row->hasProduct->name) ? $row->hasProduct->name : '' ;
                    })
                    ->addColumn('alias_unit', function ($row) {
                        return !empty($row->hasMaterialStock->hasUnit->name) ? $row->hasMaterialStock->hasUnit->name : '' ;
                    })
                    ->addColumn('alias_material_item', function ($row) {
                        return !empty($row->hasMaterialStock->hasMaterialItem->name) ? $row->hasMaterialStock->hasMaterialItem->hasProductMaterial->name.' - '.$row->hasMaterialStock->hasMaterialItem->name : '' ;
                    })
                    ->addColumn('alias_supplier', function ($row) {
                        return !empty($row->hasMaterialStock->hasSupplier->company_name) ? $row->hasMaterialStock->hasSupplier->company_name : '' ;
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>';
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
        }

        $materialStock = $this->modelMaterialStock->getAllData();

        return view('product-development.product-material.product-has-material-stock-list', 
                compact(
                    'materialStock',
                    'product'
                ));
    }

    public function show($productId, $id)
    {
        $data = $this->modelProductHasMaterialStock->getSingleDataByProduct($id, $productId);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data material dari produk tidak ditemukan'
            ], 406);
        }

        return response()->json([
            'status' => true, 
            'data' => $data,
            'messsage' => 'Data material dari produk ditemukan',
        ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
                "product_id" => "required|numeric",
                "material_stock_id" => "required|numeric",
                "qty" => "required",
            ]
        );
        $myNumber = floatval(str_replace(',', '.', $request->qty));
        $data = preg_match("/^[a-z0-9.]+$/i", $myNumber);

        $input = [
       'product_id' => $request->product_id,
       'material_stock_id' => $request->material_stock_id,
       'qty' => (($data == 1) ? $myNumber : 0),
       'note' => $request->note,
       ];
        

        $create = $this->modelProductHasMaterialStock->create($input);
        if (!$create) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Gagal menambahkan data material dari produk'
            ], 200);
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data material dari produk'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                "product_id" => "required|numeric",
                "material_stock_id" => "required|numeric",
                "qty" => "required",
            ]
        ); 
        
        $myNumber = floatval(str_replace(',', '.', $request->qty));
        $data = preg_match("/^[a-z0-9.]+$/i", $myNumber);

        $input = [
       'product_id' => $request->product_id,
       'material_stock_id' => $request->material_stock_id,
       'qty' => (($data == 1) ? $myNumber : 0),
       'note' => $request->note,
       ];
        
        $detail = $this->modelProductHasMaterialStock->getSingleDataByProduct($id, $input['product_id']);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data material dari produk tidak ditemukan'
            ], 406);
        }

        $detail->update($input);
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data material dari produk'
        ], 200);
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
                "id" => "required|numeric",
                "product_id" => "required|numeric",
            ]
        ); 

        $input = Arr::only($request->all(), [
            'id',
            'product_id'
        ]);

        $detail = $this->modelProductHasMaterialStock->getSingleDataByProduct($input['id'], $input['product_id']);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data material dari produk tidak ditemukan'
            ], 406);
        }

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data material dari produk'
        ], 200);
    }
}

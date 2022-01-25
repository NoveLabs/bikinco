<?php

namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\Product;
use App\Http\Models\ProductImage;
use App\Http\Helpers\UploadFile;
use App\Http\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $modelCategories;
    private $modelSubCategories;
    private $modelProduct;
    private $modelProductImage;

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
        $this->modelProduct = new Product();
        $this->upload = new UploadFile();
        $this->modelProductImage = new ProductImage();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with('hasSubCategories.hasCategories')->whereNull('deleted_at');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editcolumn('status', function ($row) {
                        return $row->status == 1 ? '<span class="uk-label uk-label-success">Aktif</span>' : '<span class="uk-label uk-label-danger">Tidak Aktif</span>';
                    })
                    ->editcolumn('alias_subcategories', function ($row) {
                        return !empty($row->hasSubCategories->name) ? $row->hasSubCategories->name : '' ;
                    })
                    ->editcolumn('alias_categories', function ($row) {
                        return !empty($row->hasSubCategories->hasCategories->name) ? $row->hasSubCategories->hasCategories->name : '' ;
                    })
                    ->editcolumn('created_at', function ($row) {
                        return date('d/m/Y', strtotime($row->created_at));
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>
                        <button class="sc-button sc-button-success" onclick="window.location.href = \'' . route('material-products', $row->id) .'\';" type="button">Material</button>';
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
        }

        $deactiveProductTotalData = $this->modelProduct->getTotalData(0);
        $activeProductTotalData = $this->modelProduct->getTotalData(1);

        $categories = $this->modelCategories->getAllData();

        return view('product-development.product.product-list',
                    compact(
                        'categories',
                        'deactiveProductTotalData',
                        'activeProductTotalData'
                    ));
    }

    public function show($id)
    {
        $data = $this->modelProduct->getSingleData($id);
        $data_image = $this->modelProductImage->GetProductImage($id);

        $data_image_array = [];
        if (!empty($data_image)) {
            foreach ($data_image as $item) {
                array_push($data_image_array, $item->file_name);
            }
        }
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data produk tidak ditemukan'
            ], 403);
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'image' => !empty($data_image_array) ? $data_image_array : [],
            'messsage' => 'Data produk ditemukan',
        ], 200);
    }

    public function searchSubCategories($id)
    {
        $data = $this->modelSubCategories->getAllDataByCategories($id);
        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data sub-kategori ditemukan',
        ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
                "name" => "required|unique:products",
                "price" => "required",
                "sub_categories_id" => "required|numeric",
                "weight_approx" => "required|numeric",
                "status" => "numeric|in:0,1",
                "products-file.*" => "image|mimes:jpeg,png,jpg",
            ]
        );

        $input = $request->all();

        # Change Price String to number Only
        $data_price = explode(',', $request->price);
        $input['price'] = implode('', $data_price);

        $fileName = [];
        if ($request->has('products-file')) {
            foreach ($request->file('products-file') as $image) {
                $fileName[] = $image;
            }
        }

        $params = [
            'name' => $input['name'],
            'price' => $input['price'],
            'sub_categories_id' => $input['sub_categories_id'],
            'status' => $input['status'],
            'weight_approx' => $input['weight_approx'],
        ];

        $product = $this->modelProduct->create($params);

        if (!empty($fileName)) {
            foreach ($fileName as $item) {
                $dataUpload =  $this->upload->uploadOneFile($item, 'awsfolderproduct', [
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
            $result = $this->modelProductImage->create([
                    'product_id' => $product->id,
                ]);
            $result->update([
                "file_name"           => $dataUpload['file_name'],
                "width"               => $dataUpload['width'],
                "height"              => $dataUpload['height'],
            ]);

            }
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data produk'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                "name" => "required|unique:products,name,{$id}",
                "price" => "required",
                "sub_categories_id" => "required|numeric",
                "weight_approx" => "required|numeric",
                "status" => "numeric|in:0,1",
                "status" => "numeric|in:0,1",
                "detail-products-file.*" => "image|mimes:jpeg,png,jpg",
            ]
        );

        $input = $request->all();

        # Change Price String to number Only
        $data_price = explode(',', $request->price);
        $input['price'] = implode('', $data_price);

        $detail = $this->modelProduct->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data produk tidak ditemukan.'
            ], 403);
        }

        $fileName = [];
        if ($request->has('detail-products-file')) {
            foreach ($request->file('detail-products-file') as $image) {

                $fileName[] = $image;
            }
        }

        $params = [
            'name' => $input['name'],
            'price' => $input['price'],
            'weight_approx' => $input['weight_approx'],
            'sub_categories_id' => $input['sub_categories_id'],
            'status' => $input['status'],
        ];

        $detail->update($params);

        $detailImages = $this->modelProductImage->GetProductImage($detail->id);
        $count = count($detailImages);
        for ($i=0; $i < $count ; $i++) { 
            $singleData = $this->modelProductImage->GetSingleProductImage($detailImages[$i]->id)->first();
             $dataUpload =  $this->upload->uploadOneFile($fileName[$i], 'awsfolderproduct', [
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

            $singleData->update([
                "file_name"           => $dataUpload['file_name'],
                "width"               => $dataUpload['width'],
                "height"              => $dataUpload['height'],
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data produk'
        ], 200);
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
                "id" => "required|numeric",
            ]
        );

        $input = $request->all();

        $detail = $this->modelProduct->getSingleData($input['id']);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data produk tidak ditemukan'
            ], 406);
        }

        foreach ($detail->hasImage()->get() as $image) {
            if (!empty($image->file_name)) {
                @unlink($image->file_name);
            }

            $image->delete();
        }

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data produk'
        ], 200);
    }
}

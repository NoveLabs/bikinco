<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;
use App\Http\Models\Cities;
use App\Http\Models\OrderItem;
use App\Http\Models\Product;
use App\Http\Models\Province;
use App\Http\Models\Vendor;
use App\Http\Models\VendorHasProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Eloquent\SoftDeletes;


class VendorController extends Controller
{
    private $modelProduct;
    private $modelProvince;
    private $modelCities;
    private $modelVendor;
    private $modelVendorHasProduct;
    private $modelOrderItem;

    private $vendorPrefixID;

    use SoftDeletes;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->modelProduct = new Product();
        $this->modelProvince = new Province();
        $this->modelCities = new Cities();
        $this->modelVendor = new Vendor();
        $this->modelVendorHasProduct = new VendorHasProduct();
        $this->modelOrderItem = new OrderItem();

        $this->vendorPrefixID = Config('general.vendor_prefix_id');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Vendor::with('hasProducts.hasProduct')
                                ->with('hasCities.hasProvince')
                                ->whereNull('deleted_at');

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editcolumn('is_verified', function ($row) {
                        return $row->is_verified == 1 ? '<span class="uk-label uk-label-success">Aktif</span>' : '<span class="uk-label uk-label-danger">Tidak Aktif</span>';
                    })
                    ->editcolumn('created_at', function ($row) {
                        return date('d/m/Y', strtotime($row->created_at));
                    })
                    ->addColumn('alias_id', function ($row) {
                        return $this->vendorPrefixID . $row->id;
                    })
                    ->addColumn('alias_product', function ($row) {
                        $product = '';

                        $i = 0;
                        if($row->hasProducts()->exists()){
                            foreach($row->hasProducts()->get() as $item) {
                            $product .= $item->hasProduct->name;

                            $i++;

                            if (count($row->hasProducts()->get()) > $i) {
                                $product .= ", ";
                            }

                        }
                    }
                    // }

                        return $product;
                    })
                    ->addColumn('total_order', function ($row) {
                        $total = $this->modelOrderItem->getTotalDataByVendor($row->id);

                        return '<span class="uk-label uk-label-primary">' . $total . '</span>';
                    })
                    ->addColumn('active_order', function ($row) {
                        return '<span class="uk-label uk-label-primary">0</span>';
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-mini">Detail</a>';
                    })
                    ->rawColumns(['is_verified', 'alias_id', 'total_order', 'active_order', 'action'])
                    ->make(true);
        }

        $product = $this->modelProduct->getAllData();
        $provinces = $this->modelProvince->getAllData();

        return view('sales-officer.customer.vendor-list',
                    compact(
                        'product',
                        'provinces'
                    ));
    }


    public function show($id)
    {
        $data = $this->modelVendor->getSingleData($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data vendor tidak ditemukan.'
            ], 403);
        }

        $data->fproductList = '';
        $data->fcreated_at = !empty($data->created_at) ? date('d M Y', strtotime($data->created_at)) : '-' ;
        $data->fverified_date = !empty($data->verified_date) ? date('d M Y', strtotime($data->verified_date)) : '-' ;

        $i = 0;
        foreach ($data->hasProducts()->get() as $item) {
            $data->fproductList .= $item->hasProduct->name;

            $i++;

            if (count($data->hasProducts()->get()) > $i) {
                $data->fproductList .= ", ";
            }
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data vendor ditemukan',
        ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
                "vendor_name" => "required",
                "owner_name" => "required",
                "contact" => "required",
                "email" => "required",
                "cities_id" => "required|numeric",
                "product" => "required",
                "product.*" => "required_with:product|numeric",
            ]
        );

        $input = Arr::only($request->all(), [
            'vendor_name','owner_name','contact',
            'website','email','cities_id','address','product'
        ]);

        # Change Formatted contact to whole number
        $data_number = explode('-', $request->contact);
        $input['contact'] = implode('', $data_number);

        $valid = [
            [
                'condition' => [
                    ['name' => 'vendor_name', 'opr' => '=', 'value' => $input['vendor_name'], 'opr_func' => 'where'],
                ],
                'message' => "Nama Vendor '{$input['vendor_name']}' sudah digunakan",
            ],
            [
                'condition' => [
                    ['name' => 'contact', 'opr' => '=', 'value' => $input['contact'], 'opr_func' => 'where'],
                ],
                'message' => "Kontak Vendor '{$input['contact']}' sudah digunakan",
            ],
            [
                'condition' => [
                    ['name' => 'email', 'opr' => '=', 'value' => $input['email'], 'opr_func' => 'where'],
                ],
                'message' => "Email Vendor'{$input['email']}' sudah digunakan",
            ],
        ];

        $check = FormValidation::uniqueColumnValidation('vendors', $valid);
        if (!$check['status']) {
            return $check;
        }

        $input['username'] = substr(str_replace(" ", "", $input['vendor_name']), 0, 4) . rand(000, 999);

        $create = $this->modelVendor->create($input);

        if (!empty($input['product'])) {
            foreach ($input['product'] as $item) {
                $check = $this->modelProduct->getSingleData($item);

                if (!empty($item)) {
                    $this->modelVendorHasProduct->create([
                        'product_id' => $item,
                        'vendor_id' => $create->id,
                    ]);
                }
            }
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data vendor'
        ], 200);
    }

    public function updateForm($id)
    {
        $data = $this->modelVendor->getSingleData($id);
        if (empty($data)) {
            return redirect()->route('vendors');
        }

        $productList = [];
        foreach ($data->hasProducts()->get() as $item) {
            $productList[] = $item->product_id;
        }

        $product = $this->modelProduct->getAllData();
        $cities = $this->modelCities->getAllData();
        $provinces = $this->modelProvince->getAllData();

        return view('sales-officer.customer.vendor-edit',
                    compact(
                        'data',
                        'product',
                        'cities',
                        'provinces',
                        'productList'
                    ));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                "vendor_name" => "required",
                "owner_name" => "required",
                "contact" => "required",
                "email" => "required",
                "cities_id" => "required|numeric",
                "product" => "required",
                "product.*" => "required_with:product|numeric",
            ]
        );

        $input = Arr::only($request->all(), [
            'vendor_name','owner_name','contact',
            'website','email','cities_id','address','product'
        ]);

        # Change Formatted contact to whole number
        $data_number = explode('-', $request->contact);
        $input['contact'] = implode('', $data_number);

        $detail = $this->modelVendor->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data vendor tidak ditemukan.'
            ], 403);
        }

        $valid = [
            [
                'condition' => [
                    ['name' => 'vendor_name', 'opr' => '=', 'value' => $input['vendor_name'], 'opr_func' => 'where'],
                ],
                'message' => "Nama Vendor '{$input['vendor_name']}' sudah digunakan",
            ],
            [
                'condition' => [
                    ['name' => 'contact', 'opr' => '=', 'value' => $input['contact'], 'opr_func' => 'where'],
                ],
                'message' => "Kontak Vendor '{$input['contact']}' sudah digunakan",
            ],
            [
                'condition' => [
                    ['name' => 'email', 'opr' => '=', 'value' => $input['email'], 'opr_func' => 'where'],
                ],
                'message' => "Email Vendor'{$input['email']}' sudah digunakan",
            ],
        ];

        $check = FormValidation::uniqueColumnValidation('vendors', $valid, $detail->id);
        if (!$check['status']) {
            return $check;
        }

        $detail->update($input);

        if (!empty($input['product'])) {
            $detail->hasProducts()->delete();

            foreach ($input['product'] as $item) {
                $check = $this->modelProduct->getSingleData($item);

                if (!empty($item)) {
                    $this->modelVendorHasProduct->create([
                        'product_id' => $item,
                        'vendor_id' => $detail->id,
                    ]);
                }
            }
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data vendor'
        ], 200);
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
                "id" => "required|numeric",
            ]
        );

        $input = $request->all();

        $detail = $this->modelOrderItem->getTotalDataByVendor($input['id']);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data vendor masih digunakan'
            ], 403);
        }

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data vendor'
        ], 200);
    }
}

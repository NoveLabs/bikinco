<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;
use App\Http\Helpers\FormValidation2;
use Illuminate\Http\Request;
use App\Services\CustomerService as Customer;
use App\Services\OrderService as Order;
use App\Services\ProductService as Product;
use App\Services\CategoryService as Category;
use App\Services\SizeService as Size;
use App\Services\VendorService as Vendor;
use App\Services\ArtworkService as Artwork;
use App\Services\CityService as City;
use Illuminate\Support\Facades\Session;
use App\Exceptions\ApplicationException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class OrderFormControllerTwo extends Controller
{
    private $customer;
    private $order;
    private $product;
    private $category;
    private $size;
    private $vendor;
    private $artwork;
    private $city;

    public function __construct()
    {
        $this->customer = new Customer;
        $this->order = new Order;
        $this->product = new Product;
        $this->category = new Category;
        $this->size = new Size;
        $this->vendor = new Vendor;
        $this->artwork = new Artwork;
        $this->city = new City;
    }

    public function index()
    {
        $session = Session::get('form-data');

        if (!empty($session)) {
            switch ($session['steps']) {
                case 1:

                    $customers = $this->customer->getAllCustomers();
                    $customer_prefix = config('general.customer_prefix_id');
                    $sessions = $session['steps'];
                    $categories = $this->category->getAllCategories();

                    $compact = [
                        'customers' => $customers,
                        'customer_prefix' => $customer_prefix,
                        'sessions' => $sessions,
                        'categories' => $categories,
                    ];

                    return view('sales-officer.order-form.index')->with($compact);
                    break;
                case 2:
                    $products = $this->product->filterProductsWhere('id', $session['product_id']);
                    $sizepacks = $this->size->getAllSizepacks();
                    $vendor = $this->vendor->getAllVendors();
                    $prefix_mou = config('ordertype.mou_type');
                    $artwork = $this->artwork->getAllArtworks();
                    $artwork_size = $this->artwork->getAllArtworkSizes();
                    $artwork_print = $this->product->getAllPrintTypes();
                    $artwork_methods = DB::table('artwork_print_methods')->get();
                    $sessions = $session['steps'];

                    $compact = [
                        'products' => $products,
                        'sizepack' => $sizepacks,
                        'vendor' => $vendor,
                        'prefix_mou' => $prefix_mou,
                        'artwork' => $artwork,
                        'artwork_size' => $artwork_size,
                        'artwork_print' => $artwork_print,
                        'artwork_methods' => $artwork_methods,
                        'sessions' => $sessions,
                    ];

                    return view('sales-officer.order-form.step-2')->with($compact);
                    break;
                case 3:

                    $material = $this->product->filterProductHasMaterialStocksWhere('product_id',
                        $session['product_id']);

                    $stage_a_array = [
                        'material_stocks' => [],
                        'suppliers' => [],
                        'material_item' => [],
                        'materials' => [],
                        'material_stock_colors' => [],
                        'material_colors' => [],
                        'material_color_items' => [],
                    ];

                    foreach ($material as $item) {
                        $material_stock = $this->product->filterProductMaterialStocksWhere('id',
                            $item->material_stock_id);
                        array_push($stage_a_array['material_stocks'], $material_stock);
                        foreach ($material_stock as $key => $item_b) {
                            $supplier = DB::table('suppliers')->where('id', $item_b->supplier_id)->get();
                            array_push($stage_a_array['suppliers'], $supplier);

                            $material_item = $this->product->filterProductMaterialItemsWhere('id',
                                $item_b->material_item_id);
                            array_push($stage_a_array['material_item'], $material_item);

                            foreach ($material_item as $item_c) {
                                $material = $this->product->filterProductMaterialsWhere('id',
                                    $item_c->product_material_id);
                                array_push($stage_a_array['materials'], $material);
                            }
                        }
                    }

                    foreach ($stage_a_array['material_stocks'] as $a) {
                        $stock_color = DB::table('material_stocks_has_specification_items')->where('material_stock_id',
                            $a[0]->id)->whereNull('deleted_at')->get();
                        array_push($stage_a_array['material_stock_colors'], $stock_color);
                    }

                    foreach ($stage_a_array['material_stock_colors'] as $key => $b) {
                        array_push($stage_a_array['material_colors'], $b);
                    }

                    foreach ($stage_a_array['material_colors'] as $key => $items) {
                        $array_sub_a = [];
                        foreach ($items as $keys => $a) {
                            $spec_color = DB::table('material_specification_items')->where('id',
                                $a->specification_item_id)->whereNull('deleted_at')->get();
                            array_push($array_sub_a, $spec_color);
                        }
                        array_push($stage_a_array['material_color_items'], $array_sub_a);
                    }

                    $accessories = $this->product->filterProductSpecsWhere('subcategory_id',
                        $session['subcategory_id']);
                    $stage_b_array = [
                        'specs' => [],
                    ];
                    if (!empty($accessories)) {
                        foreach ($accessories as $item) {
                            $spec_item = $this->product->filterProductSpecsWhere('id', $item->product_specification_id);
                            array_push($stage_b_array['specs'], $spec_item);
                        }
                    }

                    $stage_ab_array = [];
                    foreach ($stage_a_array['material_stocks'] as $item) {
                        $spec_color_item = DB::table('material_specification_items')->where('material_item_id',
                            $item[0]->material_item_id)->whereNull('deleted_at');

                        if ($spec_color_item->exists()) {
                            array_push($stage_ab_array, $spec_color_item->get());
                        }
                    }
                    $washing = $this->product->filterProductAddonsWhere('slug_name', 'washing');
                    $sessions = $session['steps'];

                    $compact = [
                        'material_data' => $material,
                        'material_item' => $stage_a_array,
                        'accessories_data' => $accessories,
                        'spec_items' => $stage_b_array,
                        'spec_color_items' => $stage_a_array['material_color_items'],
                        'washing' => $washing,
                        'sessions' => $sessions,
                    ];

                    return view('sales-officer.order-form.step-3')->with($compact);
                    break;
                case 4:
                    $sessions = $session['steps'];

                    $compact = [
                        'sessions' => $sessions,
                    ];

                    return view('sales-officer.order-form.step-4')->with($compact);
                    break;
                case 5:

                    $orders = $this->order->filterOrdersWhere('id', $session['order_id']);
                    $order_items = $this->order->filterItemsWhere('id', $session['order_item_id']);
                    $order_item_sizes = $this->order->filterSizesWhere('order_item_id', $session['order_id']);
                    $order_adjust_price = $this->order->filterAdjPricesWhere('order_item_id',
                        $session['order_item_id']);
                    $customers = $this->customer->filterCustomersWhere('id', $session['customer_id']);
                    $designs = $this->order->filterCustArtworksWhere('order_item_id', $session['order_item_id']);
                    $custom_design = $this->order->filterCustArtworksWhere('order_item_id', $session['order_item_id']);
                    $artworks = $this->order->filterArtworksWhere('order_item_id', $session['order_item_id']);
//
                    $custom_artworks = $this->order->filterDesignsWhere('order_item_id', $session['order_item_id']);
                    $materials = $this->order->filterMaterialsWhere('order_item_id', $session['order_item_id']);
                    $material_spec = $this->product->filterProductHasMaterialStocksWhere('product_id',
                        $session['product_id']);
                    $accessories = $this->order->filterAccessoriesWhere('order_item_id', $session['order_item_id']);
                    $sizepacks = $this->size->filterSizepacksWhere('id', $order_items->pluck('sizepack_id')[0]);
                    $sessions = $session;
                    $cities = $this->city->filterCitiesWhere('id', $customers->pluck('cities_id')[0]);
                    $province = DB::table('provinces')->where('id', $cities->pluck('province_id')[0])->get();
                    $products = $this->product->filterProductsWhere('id', $order_items->pluck('product_id')[0]);
                    $vendors = $this->vendor->filterVendorsWhere('id', $order_items->pluck('vendor_id')[0]);
                    $product_addons = $this->product->filterProductAddonsWhere('id', $order_items->pluck
                    ('is_washing')[0]);

                    $stage_6_array = [];
                    $stage_7_array = [];
                    foreach ($order_item_sizes as $item) {
                        $sizes = $this->size->filterSizesWhere('id', $item->size_id);
                        $size_types = $this->size->filterSizeTypesWhere('id', $item->size_type_id);
                        array_push($stage_6_array, $sizes);
                        array_push($stage_7_array, $size_types);
                    }
                    $stage_1_array = [];
                    foreach ($material_spec as $item) {
                        $material_stock = $this->product->filterProductMaterialStocksWhere('id',
                            $item->material_stock_id);
                        array_push($stage_1_array, $material_stock);
                    }

                    $ord_mt_stck_has_spec_items = [];
                    foreach ($material_spec as $item) {
                        $data = DB::table('material_stocks_has_specification_items')->where('material_stock_id',
                            $item->material_stock_id)->get();
                        array_push($ord_mt_stck_has_spec_items, $data);
                    }

                    $ord_color_item = [];
                    foreach ($ord_mt_stck_has_spec_items as $key => $item) {
                        $data = DB::table('material_specification_items')->where('id',
                            $session['data_color_item'][$key])->get();
                        array_push($ord_color_item, $data);
                    }

                    $stage_2_array = [];
                    foreach ($stage_1_array as $key => $item) {
                        $material_item = $this->product->filterProductMaterialItemsWhere('id',
                            $item[0]->material_item_id);
                        array_push($stage_2_array, $material_item);
                    }
                    $stage_3_array = [];
                    foreach ($stage_2_array as $item) {
                        $material_data = $this->product->filterProductMaterialsWhere('id',
                            $item[0]->product_material_id);
                        array_push($stage_3_array, $material_data);
                    }
                    $stage_4_array = [];
                    foreach ($accessories as $item) {
                        $products_spec = $this->product->filterProductSpecsWhere('id', $item->product_specification_id);
                        array_push($stage_4_array, $products_spec);
                    }

                    $stage_color_array = [];
                    foreach ($stage_1_array as $item) {
                        $material_color = DB::table('material_specification_items')->where('material_item_id',
                            $item[0]->material_item_id)->get();
                        array_push($stage_color_array, $material_color);
                    }

                    $order_artwork_position = [];
                    $order_artwork_size = [];
                    $order_artwork_print_types = [];
                    $order_artwork_print_methods = [];
                    foreach ($artworks as $key => $item) {
                        // Position
                        $position = $this->artwork->filterArtworkBy('id', $item->artwork_position);
                        array_push($order_artwork_position, $position);

                        // Size
                        $size = $this->artwork->filterArtworkSizeBy('id', $item->artwork_size_id);
                        array_push($order_artwork_size, $size);

                        // Print Types
                        $print_types = DB::table('artwork_print_types')->where('id',
                            $item->artwork_print_type_id)->get();
                        array_push($order_artwork_print_types, $print_types);

                        $print_methods = DB::table('artwork_print_methods')->where('id', $item->artwork_method_id)
                            ->get();
                        array_push($order_artwork_print_methods, $print_methods);
                    }

                    $order_item_accessories = [];
                    $product_spec_items = [];
                    foreach ($accessories as $key => $item) {
                        $data = $this->product->filterProductSpecItemsWhere('id', $item->product_specification_item_id);
                        array_push($order_item_accessories, $data);

                        // Product_spec
                        $product_specs = $this->product->filterProductSpecsWhere('id',
                            $order_item_accessories[$key][0]->pluck('product_specification_id')[0]);
                        array_push($product_spec_items, $product_specs);
                    }

                    $mou_type_customer = $this->mouCustomerType($order_items[0]->cust_to_own_type);
                    $mou_type_provider = $this->mouCustomerType($order_items[0]->own_to_cust_type);

                    $compact = [
                        'orders' => $orders,
                        'order_items' => $order_items,
                        'order_item_sizes' => $order_item_sizes,
                        'order_adjust_price' => $order_adjust_price,
                        'customers' => $customers,
                        'designs' => $designs,
                        'custom_design' => $custom_design,
                        'artworks' => $artworks,
                        'custom_artworks' => $custom_artworks,
                        'materials' => $materials,
                        'material_spec' => $material_spec,
                        'accessories' => $accessories,
                        'accessories_name' => $order_item_accessories,
                        'accessories_spec_name' => $product_spec_items,
                        'sizepacks' => $sizepacks,
                        'session_data' => $sessions,
                        'cities' => $cities,
                        'province' => $province,
                        'products' => $products,
                        'sizes' => $stage_6_array,
                        'size_types' => $stage_7_array,
                        'material_stock' => $stage_1_array,
                        'material_item' => $stage_2_array,
                        'material_data' => $stage_3_array,
                        'product_spec' => $stage_4_array,
                        'product_spec_item' => [],
                        'customer_mou' => $mou_type_customer,
                        'provider_mou' => $mou_type_provider,
                        'material_color' => $ord_color_item,
                        'artwork_size' => $order_artwork_size,
                        'artwork_pos' => $order_artwork_position,
                        'artwork_print' => $order_artwork_print_types,
                        'artwork_method' => $order_artwork_print_methods,
                        'vendors' => $vendors,
                        'product_addons' => !empty($product_addons) ? $product_addons : '',
                    ];

                    //                    dd($compact);

                    return view('sales-officer.order-form.step-5')->with($compact);
                    break;
                default:
                    return abort(404);
                    break;
            }
        }

        Session::forget('form-data');
        $session['steps'] = 1;
        Session::put('form-data', $session);

        $customers = $this->customer->getAllCustomers();
        $customer_prefix = config('general.customer_prefix_id');
        $sessions = $session['steps'];
        $categories = $this->category->getAllCategories();

        $compact = [
            'customers' => $customers,
            'customer_prefix' => $customer_prefix,
            'sessions' => $sessions,
            'categories' => $categories,
        ];

        return view('sales-officer.order-form.index')->with($compact);
    }

    public function stepOne(Request $request, Order $order, Size $size)
    {
        $request_validation = [
            'session' => 'required',
            'customer_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'subcategory_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'size_id' => 'required',
            'size_type_id' => 'required',
            'data_order_priority' => 'required|numeric|in:0,1',
            'qty' => 'required',
        ];
        $request->validate($request_validation);

        $required = [
            'session',
            'customer_id',
            'category_id',
            'subcategory_id',
            'product_id',
            'size_id',
            'size_type_id',
            'data_order_priority',
            'qty',

        ];
        $data = Arr::only($request->all(), $required);

        DB::beginTransaction();

        // This function is used for step 1 only
        if ($data['session'] != 1) {
            throw new ApplicationException('Session Data mismatch, please reload your browser and try again.');
        }

        // Data checking
        if (count($data['size_id']) != count($data['size_type_id'])
            or count($data['size_id']) != count($data['qty'])
            or count($data['size_type_id']) != count($data['qty'])
        ) {
            throw new ApplicationException('Data Length Mistmatch, please reload your browser and try again');
        }

        // Step 1 - Create Order
        $data_set = [
            'customer_id' => $data['customer_id'],
            'payment_method' => 1,
            'payment_type' => 2,
            'order_date' => now(),
            'last_step' => $data['session'],
            'is_priority' => $data['data_order_priority'],
            'last_step_date' => now(),
            'created_at' => now(),
        ];

        $order_insert = $this->order->createOrder($data_set);

        if (!$order_insert) {
            throw new ApplicationException('Data Cannot be inserted, please try again');
        }

        // Step 2 - Order Item Insertion
        $order_item_param = [
            'order_id' => $order_insert->id,
            'product_id' => $data['product_id'],
            'priority' => $data['data_order_priority'],
            'order_date' => now(),
        ];

        $order_item_insert = $this->order->createItem($order_item_param);

        $quantity_total = 0;
        if (!empty($data['size_id'])) {

            foreach ($data['size_id'] as $key => $size_item) {
                $sizeData = $this->size->filterSizesWhere('id', $size_item);
                $sizeType = $this->size->filterSizeTypesWhere('id', $data['size_type_id'][$key]);

                $array = [
                    'order_item_id' => $order_insert->id,
                    'size_id' => $sizeData->pluck('id')[0],
                    'size_type_id' => $sizeType->pluck('id')[0],
                    'qty' => $data['qty'][$key],
                    'amount' => !empty($sizeType[0]->extra_price)
                        ? $sizeType[0]->extra_price : 0,
                ];

                $this->order->createSize($array);
                $quantity_total += $data['qty'][$key];
            }

        }

        // Step 3 - Update Order Data
        $raw_data = [
            'total_item' => $quantity_total,
            'updated_at' => now(),
        ];

        $this->order->updateOrder($order_insert->id, $raw_data);

        //create new session to validate next process of foc...
        $sessions = [
            'steps' => 2,
            'order_id' => $order_insert->id,
            'order_item_id' => $order_item_insert->id,
            'order_item_qty' => $quantity_total,
            'qty' => array_sum($request->qty),
            'customer_id' => $data['customer_id'],
            'subcategory_id' => $data['subcategory_id'],
            'product_id' => $data['product_id'],
        ];

        Session::put('form-data', $sessions);

        DB::commit();

        $response = [
            'status' => true,
            'code' => 200,
            'data' => [],
            'message' => 'OK',
        ];

        return response()->json($response);
    }

    public function stepTwo(Request $request)
    {
        $session_data = Session::get('form-data');
        $request_param = [
            'session' => 'required|numeric',
            'data_customer_order_type' => 'required|numeric|in:1,2',
            'data_provider_order_type' => 'required|numeric|in:1,2',
            'data_sizepack' => 'required|numeric',

            'f-payment' => 'required|numeric|in:0,1,2',
            'data_has_custom_label_upload' => 'required_if:f-payment,==,2',
            'data_has_custom_label_notes' => 'nullable',

            'data_has_packaging' => 'required|numeric|in:0,1',
            'data_has_packaging_upload' => 'required_if:data_has_packaging,==,1',
            'data_has_packaging_notes' => 'nullable',

            'data_has_design' => 'required|numeric|in:0,1',
            'data_has_design_title' => 'required_if:data_has_design,==,1',
            'data_has_design_title.*' => 'required_if:data_has_design,==,1',
            'data_has_design_upload' => 'required_if:data_has_design,==,1',
            'data_has_design_upload.*' => 'required_if:data_has_design,==,1',

            'data_has_artwork' => 'required|numeric|in:0,1',
            'data_has_artwork_position' => 'required_if:data_has_artwork,==,1',
            'data_has_artwork_position.*' => 'required_if:data_has_artwork,==,1',
            'data_has_artwork_size' => 'required_if:data_has_artwork,==,1',
            'data_has_artwork_size.*' => 'required_if:data_has_artwork,==,1',
            'data_has_artwork_print_type' => 'required_if:data_has_artwork,==,1',
            'data_has_artwork_print_type.*' => 'required_if:data_has_artwork,==,1',
            'data_has_artwork_color_qty' => 'required_if:data_has_artwork,==,1',
            'data_has_artwork_color_qty.*' => 'required_if:data_has_artwork,==,1',
            'data_has_artwork_upload' => 'required_if:data_has_artwork,==,1',
            'data_has_artwork_upload.*' => 'required_if:data_has_artwork,==,1',
            'data_has_artwork_vector_upload' => 'required_if:data_has_artwork,==,1',
            'data_has_artwork_vector_upload.*' => 'required_if:data_has_artwork,==,1',
            'data_has_artwork_print_methods' => 'required_if:data_has_artwork,==,1',
            'data_has_artwork_print_methods.*' => 'required_if:data_has_artwork,==,1',

            'data_has_design_reference' => 'required_if:data_has_design,==,0|numeric|in:0,1',
            'data_has_design_reference_link' => 'required_if:data_has_design_reference_upload,==,null',
            'data_has_design_reference_upload' => 'required_if:data_has_design_reference_link,==,null',

            'data_has_artwork_reference' => 'required_if:data_has_artwork,==,0|numeric|in:0,1',
            'data_has_artwork_reference_link' => 'required_if:data_has_artwork_reference_upload,==,null',
            'data_has_artwork_reference_upload' => 'required_if:data_has_artwork_reference_link,==,null',

            'data_customer_start_date' => 'required',
            'data_customer_finish_date' => 'required',
            'data_vendor' => 'required|numeric',
            'data_vendor_start_date' => 'required',
            'data_vendor_finish_date' => 'required',
            'data_order_notes' => 'nullable',
        ];

        $this->validate($request, $request_param);

        $arr_only = [
            'session',
            'data_customer_order_type',
            'data_provider_order_type',
            'data_sizepack',
            'f-payment',
            'data_has_custom_label_upload',
            'data_has_custom_label_notes',
            'data_has_packaging',
            'data_has_packaging_upload',
            'data_has_packaging_notes',
            'data_has_design',
            'data_has_design_title',
            'data_has_design_upload',
            'data_has_artwork',
            'data_has_artwork_position',
            'data_has_artwork_size',
            'data_has_artwork_print_type',
            'data_has_artwork_color_qty',
            'data_has_artwork_upload',
            'data_has_artwork_vector_upload',
            'data_has_artwork_print_methods',
            'data_has_design_reference',
            'data_has_design_reference_link',
            'data_has_design_reference_upload',
            'data_has_artwork_reference',
            'data_has_artwork_reference_link',
            'data_has_artwork_reference_upload',
            'data_customer_start_date',
            'data_customer_finish_date',
            'data_vendor',
            'data_vendor_start_date',
            'data_vendor_finish_date',
            'data_order_notes',
        ];

        $data = Arr::only($request->all(), $arr_only);

        // Begin Transaction
        DB::beginTransaction();

        // Step 1 = Check if artwork array data length has same length
        if ($data['data_has_artwork'] == '1') {
            if (
                count($data['data_has_artwork_position'])
                != count($data['data_has_artwork_size']) or
                count($data['data_has_artwork_position'])
                != count($data['data_has_artwork_print_type']) or
                count($data['data_has_artwork_position'])
                != count($data['data_has_artwork_color_qty']) or
                count($data['data_has_artwork_position'])
                != count($data['data_has_artwork_upload']) or
                count($data['data_has_artwork_position'])
                != count($data['data_has_artwork_vector_upload']) or
                count($data['data_has_artwork_size'])
                != count($data['data_has_artwork_print_type']) or
                count($data['data_has_artwork_size'])
                != count($data['data_has_artwork_color_qty']) or
                count($data['data_has_artwork_size'])
                != count($data['data_has_artwork_upload']) or
                count($data['data_has_artwork_size'])
                != count($data['data_has_artwork_vector_upload']) or
                count($data['data_has_artwork_print_type'])
                != count($data['data_has_artwork_color_qty']) or
                count($data['data_has_artwork_print_type'])
                != count($data['data_has_artwork_upload']) or
                count($data['data_has_artwork_print_type'])
                != count($data['data_has_artwork_vector_upload']) or
                count($data['data_has_artwork_color_qty'])
                != count($data['data_has_artwork_upload']) or
                count($data['data_has_artwork_color_qty'])
                != count($data['data_has_artwork_vector_upload']) or
                count($data['data_has_artwork_upload'])
                != count($data['data_has_artwork_vector_upload'])
            ) {
                throw new ApplicationException('Data Counter mismatch, please reload the browser and try again');
            }
        }


        // Step 2 - Get product id from session
        $get_session = Session::get('form-data');

        if (empty($get_session)) {
            return redirect()->route('orderForm.index');
        }

        // Step 3 - Get Product Data
        $product_data = $this->product->filterProductsWhere('id', $session_data['product_id']);

        if ($product_data == null) {
            throw new ApplicationException('Product Data is Null');
        }

        // Step 4 - Get Order data
        $order_data = $this->order->filterOrdersWhere('id', $session_data['order_id']);

        if (!$order_data) {
            throw new ApplicationException('Order Data is Null');
        }

        // Step 5 - Get Order Item Data
        $order_item_data = $this->order->filterItemsWhere('id', $session_data['order_item_id']);

        if (!$order_item_data) {
            throw new ApplicationException('Order Item Data is Null');
        }

        // Step 6 - get Product Id
        $data['product_id'] = $product_data[0]->id;

        // Step 7 - if Label is selected custom, then upload the file
        if ($data['f-payment'] == '2') {
            $label_data = FormValidation::uploadOne($request, 'data_has_custom_label_upload',
                'upload_image/order/label', 'label_order_id_' . $order_data->pluck('id')[0] . uniqid());
            if (!empty($label_data)) {
                $data['label_data'] = $label_data;
            }
        } else {
            $data['label_data'] = $data['f-payment'];
        }

        // Step 8 - If Package is Selected custom, then upload the file
        if ($data['data_has_packaging'] == '1') {
            $packaging_data = FormValidation::uploadOne($request, 'data_has_packaging_upload',
                'upload_image/order/packaging', 'packaging_order_id_' . $order_data->pluck('id')[0] . uniqid());

            if (!empty($packaging_data)) {
                $data['packaging_data'] = $packaging_data;
            }
        }

        // Step 9 - Update Order Data
        $order_item_update_raw = [
            'sizepack_id' => $data['data_sizepack'],
            'cust_to_own_type' => $data['data_customer_order_type'],
            'own_to_cust_type' => $data['data_provider_order_type'],
            'is_custom_label' => $data['f-payment'],
            'label_photo' => $data['label_data'],
            'is_repackaging' => $data['data_has_packaging'],
            'packaging_note' => !empty($data['data_has_packaging_notes'])
                ? $data['data_has_packaging_notes'] : null,
            'packaging_photo' => !empty($data['packaging_data'])
                ? $data['packaging_data'] : null,
            'design_note' => !empty($data['data_has_design_note'])
                ? $data['data_has_design_note'] : null,
            'order_date' => $data['data_customer_start_date'],
            'completed_date' => $data['data_customer_finish_date'],
            'vendor_id' => $data['data_vendor'],
            'vendor_mou_date' => $data['data_vendor_start_date'],
            'vendor_mou_completed_date' => $data['data_vendor_finish_date'],
            'note' => $data['data_order_notes'],
            'updated_at' => now(),
        ];

        $this->order->updateItem($order_item_data[0]->id, $order_item_update_raw);

        //Step 10 - if has custom_artwork, insert into order item artwork
        if ($data['data_has_design'] == '1') {

            foreach ($data['data_has_design_title'] as $key => $item) {
                $array = [
                    'order_item_id' => $order_item_data->pluck('id')[0],
                    'title' => $item,
                ];

                $image_data = FormValidation2::uploadOne($request->file('data_has_design_upload')[$key],
                    'upload_image/order/design', 'design_order_id_' . $order_data->pluck('id')[0] . uniqid());

                $array['photo'] = $image_data;
                $this->order->createCustArtwork($array);
            }

        }

        // Step 11 - if has custom artwork, loop and insert
        if ($data['data_has_artwork'] == '1') {

            foreach ($data['data_has_artwork_position'] as $key => $item) {

                $get_print_type = $this->product->filterPrintTypesWhere('id',
                    $data['data_has_artwork_print_type'][$key]);

                $array = [
                    'order_item_id' => $order_item_data->pluck('id')[0],
                    'artwork_size_id' => $data['data_has_artwork_size'][$key],
                    'product_addon_id' => 0,
                    'artwork_print_type_id' => intval($data['data_has_artwork_print_type'][$key]),
                    'artwork_method_id' => $data['data_has_artwork_print_methods'][$key],
                    'artwork_position' => $item,
                    'color_qty' => $data['data_has_artwork_color_qty'][$key],
                    'amount' => !empty($get_print_type->pluck('price')[0]) ? $get_print_type->pluck('price')[0] : 0,
                ];

                $data_preview = FormValidation2::uploadOne($request->file('data_has_artwork_upload')[$key],
                    'upload_image/order/artwork', 'artwork_preview_order_id_' . $order_data->pluck('id')[0] . uniqid());
                $array['preview_image'] = $data_preview;

                $data_zip = FormValidation2::uploadOne($request->file('data_has_artwork_vector_upload')[$key],
                    'upload_image/order/artwork', 'artwork_zip_order_id' . $order_data->pluck('id')[0] . uniqid());
                $array['zip_file'] = $data_zip;

                $this->order->createArtwork($array);
            }
        }

        // Step 12 - Check any references
        if ($data['data_has_design_reference'] == 1) {
            if (!empty($data['data_has_design_reference_link'])) {

                $data = [
                    'order_item_id' => $order_data->pluck('id')[0],
                    'title' => 'Design Reference '
                        . $order_data->pluck('id')[0],
                    'preview_image' => $data['data_has_design_reference_link'],
                ];

                $create_new_cust_artwork = $this->order->createDesign($data);

                if (!$create_new_cust_artwork) {
                    throw new ApplicationException('Failed to insert design reference link data to Order Item Cust Customer, Please check and try again');
                }
            }

            if (!empty($data['data_has_design_reference_upload'])) {

                $reference_upload = FormValidation::uploadOne($request, 'data_has_design_reference_upload',
                    'upload_image/order/design', 'design_reference_order_id_' . $order_data->pluck('id')[0] . uniqid());

                $data = [
                    'order_item_id' => $order_data->pluck('id')[0],
                    'title' => 'Design Reference ' . $order_data->pluck('id')[0],
                    'preview_image' => $reference_upload,
                ];

                $create_new_cust_artwork = $this->order->createDesign($data);

                if (!$create_new_cust_artwork) {
                    throw new ApplicationException('Failed to insert design reference photo data to Order Item Cust Customer, Please check and try again');
                }
            }
        }

        if ($request->data_has_artwork_reference == '1') {
            if (!empty($request->data_has_artwork_reference_link)) {
                $data = [
                    'order_item_id' => $order_data->pluck('id')[0],
                    'title' => 'Customer Reference '
                        . $order_data->pluck('id')[0],
                    'preview_image' => $request->data_has_artwork_reference_link,
                ];

                $create_new_cust_artwork = $this->order->createDesign($data);

                if (!$create_new_cust_artwork) {
                    throw new ApplicationException('Failed to insert artwork reference link data to Order Item Cust Customer, Please check and try again');
                }
            }

            if (!empty($request->data_has_artwork_reference_upload)) {

                $reference_upload = FormValidation::uploadOne($request, 'data_has_artwork_reference_upload',
                    'upload_image/order/artwork',
                    'artwork_reference_order_id_' . $order_data->pluck('id')[0] . uniqid());

                $data = [
                    'order_item_id' => $order_data->pluck('id')[0],
                    'title' => 'Customer Reference '
                        . $order_data->pluck('id')[0],
                    'preview_image' => $reference_upload,
                ];

                $create_new_cust_artwork = $this->order->createDesign($data);

                if (!$create_new_cust_artwork) {
                    throw new ApplicationException('Failed to insert artwork reference photo data to Order Item Cust Customer, Please check and try again');
                }
            }
        }

        // Step 13 - Update Last step
        $step_param = [
            'last_step' => 2,
            'last_step_date' => now(),
        ];

        $this->order->updateOrder($order_data[0]->id, $step_param);

        $get_session['steps'] = 3;
        Session::put('form-data', $get_session);

        DB::commit();

        //passing or return true result...
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data pesanan',
        ], 200);
    }

    public function stepThree(Request $request)
    {
        $session_data = Session::get('form-data');

        $request_param = [
            'session' => 'required|numeric|in:3',
            'data_access_chooser' => 'nullable',
            'data_color_item' => 'nullable',
            'data_access_type' => 'nullable',
            'data_has_washing' => 'required|numeric|in:0,1',
            'data_washing_type' => 'required_if:data_has_washing,==,1',
            'data_access_notes' => 'nullable',
        ];

        $request->validate($request_param);

        $array_only = [
            'session',
            'data_access_chooser',
            'data_access_type',
            'data_has_washing',
            'data_washing_type',
            'data_access_notes',
            'data_color_item'
        ];

        $data = Arr::only($request->all(), $array_only);

        // Begin Transaction

        DB::beginTransaction();

        if ($data['session'] != '3') {
            throw new ApplicationException('Data Session tidak sesuai, silakan muat ulang dan coba kembali');
        }

        if (!empty($data['data_access_chooser'])) {
            if (
                count($data['data_access_chooser'])
                != count($data['data_access_type']) or
                count($data['data_access_chooser'])
                != count($data['data_access_notes']) or
                count($data['data_access_type'])
                != count($data['data_access_notes'])
            ) {
                throw new ApplicationException('Terdapat kesalahan dalam mendapatkan jumlah material, silakan coba kembali');
            }
        }


        $get_session = $session_data;
        if (empty($get_session)) {
            throw new ApplicationException('Data Session kosong, silakan muat ulang dan coba kembali');

        }

        $order_data = $this->order->filterOrdersWhere('id', $get_session['order_id']);

        if (empty($order_data)) {
            throw new ApplicationException('Data Order kosong, silakan muat ulang dan coba kembali');
        }

        $order_item_data = $this->order->filterItemsWhere('id', $get_session['order_item_id']);

        if (empty($order_item_data)) {
            throw new ApplicationException('Data Order Item kosong, silakan muat ulang dan coba kembali');
        }

        // Store Material
        $product_material_stocks = $this->product->filterProductHasMaterialStocksWhere('product_id',
            $get_session['product_id']);

        $arr_material_stocks = [];
        foreach ($product_material_stocks as $key => $item) {
            array_push($arr_material_stocks, $item);
        }

        $arr_mt_stock_has_spec_items = [];
        foreach ($arr_material_stocks as $item) {
            $data = DB::table('material_stocks_has_specification_items')->where('material_stock_id', $item->id)->get();
            array_push($arr_mt_stock_has_spec_items, $item);
        }


        $arr_mt_spec_items = [];
        foreach ($arr_mt_stock_has_spec_items as $key => $item) {
            $data = DB::table('material_specification_items')->where('id', $request->data_color_item[$key])->get();
            array_push($arr_mt_spec_items, $data);
        }

        $arr_ord_color_items = [];
        foreach ($arr_mt_spec_items as $key => $item) {
            $array = [
                'order_item_id' => $get_session['order_item_id'],
                'material_stock_id' => $arr_material_stocks[$key]->material_stock_id,
                'material_specification_id' => 0,
                'material_color_id' => $request->data_color_item[$key],
                'qty' => $session_data['qty'],
                'amount' => 0,
            ];

            $this->order->createMaterial($array);
        }

        // Store Accessories
        $data_price_amount = [];
        if ($request->data_access_chooser[0] !== null && $request->data_access_type[0] !== null) {
            foreach ($request->data_access_chooser as $key => $item) {
                $get_product_item = $this->product->filterProductSpecItemsWhere('id',
                    $request->data_access_type[$key]);

                $array = [
                    'order_item_id' => $get_session['order_item_id'],
                    'product_specification_item_id' => $request->data_access_type[$key],
                    'qty' => $session_data['qty'],
                    'amount' => !empty($get_product_item[0]->price) ? $get_product_item[0]->price : 0,
                    'note' => $request->data_access_notes[$key],
                ];

                $this->order->createAccessories($array);
            }
        }

        // Washing
        if (!empty($data['data_has_washing'])
            && !empty($data['data_washing_type'])
        ) {
            $param = [
                'is_washing' => $request->data_has_washing,
                'washing_id' => $data['data_washing_type'],
            ];

            $this->order->updateItem($order_item_data[0]->id, $param);
        }

        // Updating Last step
        $param = [
            'last_step' => '3',
            'last_step_date' => now(),
        ];

        $this->order->updateOrder($order_data[0]->id, $param);

        $get_session['steps'] = 4;
        $get_session['data_color_item'] = $request->data_color_item;
        Session::put('form-data', $get_session);

        DB::commit();

        $response = [
            'status' => true,
            'code' => 200,
            'data' => [],
            'message' => 'OK',
        ];

        return response()->json($response);
    }

    public function StepFour(Request $request)
    {
        $session_data = Session::get('form-data');
        $request_param = [
            'session' => 'required|numeric|in:4',
            'data_price_title' => 'nullable',
            'data_price_amount' => 'nullable',
            'data_price_qty' => 'nullable',
            'f-payment' => 'required|numeric|in:0,1',
            'f-payment-type' => 'required|numeric|in:0,1',
            'data_payment_amount' => 'required_if:f-payment,==,1',
        ];

        $request->validate($request_param);

        # Change Price String to number Only
        $data_price = explode(',', $request->data_payment_amount);
        $request->data_payment_amount = implode('', $data_price);


        $array_only = [
            'session',
            'data_price_title',
            'data_price_amount',
            'data_price_qty',
            'f-payment',
            'f-payment-type',
            'data_payment_type',
        ];
        $data = Arr::only($request->all(), $array_only);

        // Begin Transaction
        DB::beginTransaction();

        if (!$data['session'] == '4') {
            throw new ApplicationException('Session ID tidak sesuai, silakan muat ulang dan coba lagi');
        }

        if (
            count($data['data_price_title'])
            != count($data['data_price_amount']) or
            count($data['data_price_title'])
            != count($data['data_price_qty']) or
            count($data['data_price_amount'])
            != count($data['data_price_qty'])
        ) {
            throw new ApplicationException('Jumlah isian tidak sesuai, silakan muat ulang dan coba kembali');
        }

        if (empty($session_data)) {
            throw new ApplicationException('Data Session kosong, silakan muat ulang dan coba kembali');
        }

        $product_data = $this->product->filterProductsWhere('id', $session_data['product_id']);

        if (empty($product_data)) {
            throw new ApplicationException('Produk tidak ditemukam, silakan coba kembali');
        }

        $order_data = $this->order->filterOrdersWhere('id', $session_data['order_id']);

        if (empty($order_data)) {
            throw new ApplicationException('Order Data tidak ditemukan, silakan coba kembali');
        }

        $order_item_data = $this->order->filterItemsWhere('id', $session_data['order_item_id']);

        if (empty($order_item_data)) {
            throw new ApplicationException('Order Item Data Kosong, Silakan coba kembali');
        }

        // Save Adjust Price
        if (!empty($data['data_price_title'])) {
            foreach ($data['data_price_title'] as $key => $price_title_item) {
                $array = [
                    'order_item_id' => $order_item_data[0]->id,
                    'adjust_amount' => ($data['data_price_amount'][$key]
                        * $data['data_price_qty'][$key]),
                    'note' => $price_title_item,
                ];

                $this->order->createAdjPrice($array);
            }
        }

        // Get Al Prices
        $sum_size_amount = $this->order->filterSizesWhere('order_item_id', $order_data[0]->id);
        $sum_adj_price_amount = $this->order->sumAdjPrice($order_item_data[0]->id);
        $sum_accs_amount = $this->order->sumAccessories($order_item_data[0]->id);
        $sum_artwork_amount = $this->order->sumArtworks($order_item_data[0]->id);
        $sum_material_amount = $this->order->sumMaterial($order_item_data[0]->id);

        // Do Calculation
        $calc_array = [
            $sum_accs_amount,
            $sum_artwork_amount,
            $sum_material_amount,
            $product_data[0]->price,
        ];

        $productPerPcs = array_sum($calc_array);

        $price_data = [];
        foreach ($sum_size_amount as $size_price) {
            $item_price = $productPerPcs * $size_price->qty;
            array_push($price_data, $item_price);
        }

        $total_product_price = array_sum($price_data);

        # Raw total Price
        $product_price_array = [
            $sum_artwork_amount,
            $sum_material_amount,
            $product_data[0]->price,
        ];

        $product_raw_total = (array_sum($product_price_array)) * $order_data[0]->total_item;


        // Down Payment
        if ($data['f-payment'] == '0') {
            $data['total_payment'] = 0;
            $session_data['payment_percentage'] = 0;
        }

        if ($data['f-payment'] == '1') {
            if ($data['f-payment-type'] == '1') {
                if (intval($request->data_payment_amount) >= 100) {
                    $sub = (intval($request->data_payment_amount) / ($total_product_price + $sum_adj_price_amount)) * 100;
                    $data['total_payment'] = $request->data_payment_amount;
                    $session_data['total_payment'] = $request->data_payment_amount;
                    $session_data['payment_percentage'] = round($sub, 1);
                }

                if (intval($request->data_payment_amount) <= 100) {
                    $sub = (intval($request->data_payment_amount) / 100) * ($total_product_price + $sum_adj_price_amount);
                    $data['total_payment'] = $sub;
                    $session_data['payment_percentage'] = 0;
                    $session_data['total_payment'] = $sub;
                }
            }

            if ($data['f-payment-type'] == '0') {
                //                $data['total_payment'] = $request->data_payment_amount;
                $data['total_payment'] = 0;
                $session_data['payment_percentage'] = 0;
                $session_data['total_payment'] = $request->data_payment_amount;
            }
        }


        // Update total amount
        $session_data['total_payment_data'] = (intval($sum_adj_price_amount) + intval($total_product_price));

        // Update Param
        $param = [
            'last_step' => 4,
            'last_step_date' => now(),
            'payment_type_value' => $request->data_payment_amount,
            'total_amount' => $session_data['total_payment_data'],
            'part_paid_amount' => $data['total_payment'],
        ];

        $this->order->updateOrder($order_data[0]->id, $param);

        $session_data['payment_method'] = $data['f-payment'];

        $params = [
            'product_price' => $product_data[0]->price,
            'sum_product_price' => $product_raw_total,
            'sum_size_price' => $sum_size_amount,
            'sum_accs_price' => $sum_accs_amount,
            'sum_adj_price' => $sum_adj_price_amount,
            'sum_artworks_price' => $sum_artwork_amount,
            'sum_material_price' => $sum_material_amount,
        ];

        $this->order->updateItem($order_item_data[0]->id, $params);

        $session_data['steps'] = 5;
        Session::put('form-data', $session_data);

        DB::commit();

        $message = [
            'status' => true,
            'code' => 200,
            'data' => [],
            'message' => 'OK',
        ];

        return response()->json($message);
    }

    public function StepFive(Request $request)
    {
        $session_data = Session::get('form-data');

        $order_data = $this->order->filterOrdersWhere('id', $session_data['order_id']);

        DB::beginTransaction();

        // Update Order
        $param = [
            'order_status_id' => 1,
            'last_step' => 5,
            'is_fulfilled' => 1,
            'last_step_date' => now(),
        ];

        $this->order->updateOrder($session_data['order_id'], $param);

        DB::commit();

        $response = [
            'status' => true,
            'code' => 200,
            'data' => route('home'),
            'message' => "Berhasil Menambahkan Order",
        ];

        return response()->json($response);
    }

    public function flush(Request $request)
    {
        Session::forget('form-data');

        return redirect()->route('foc.form.index');
    }

    public function mouCustomerType($id)
    {
        $prefix_mou = config('ordertype.mou_type');
        $array = [];
        foreach ($prefix_mou as $item) {
            if ($item['id'] == $id) {
                array_push($array, $item);
            }
        }
        return $array;
    }
}

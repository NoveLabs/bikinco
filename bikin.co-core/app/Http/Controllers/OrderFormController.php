<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use App\Repositories\Category\Category;
    use App\Repositories\Customer\Customer;
    use App\Repositories\Order\Order;
    use App\Repositories\Product\Product;
    use App\Repositories\ProductPrint\ProductPrint;
    use App\Repositories\Size\Size;
    use App\Repositories\Sizepack\Sizepack;
    use App\Repositories\Vendor\Vendor;
    use Illuminate\Support\Facades\Session;
    use PharIo\Manifest\InvalidApplicationNameException;
    use App\Exceptions\ApplicationException;
    use Illuminate\Support\Arr;
    use App\Http\Helpers\FormValidation;
    use App\Http\Helpers\FormValidation2;
    use Illuminate\Support\Carbon;

    class OrderFormController extends Controller
    {
        private $customer;
        private $order;
        private $product;
        private $category;
        private $size;

        public function __construct(
            Order $order,
            Customer $customer,
            Product $product,
            Category $category,
            Size $size
        ) {
            $this->customer = $customer;
            $this->order    = $order;
            $this->product  = $product;
            $this->category = $category;
            $this->size     = $size;
        }

        public function index()
        {
            $session_data = Session::get('form-data');

            if ( ! empty($session_data)) {
                switch ($session_data['steps']) {
                    case 1:
                        $compact = [
                            'customers'       => $this->customer->getAllCustomers(),
                            'customer_prefix' => config('general.customer_prefix_id'),
                            'sessions'        => $session_data['steps'],
                            'categories'      => $this->category->getAllCategories(),
                        ];

                        return view('sales-officer.order-form.index')->with($compact);
                        break;
                    case 2:
                        $compact = [
                            'product'       => $this->product->getProductDetail($session_data['product_id'])[0],
                            'sizepack'      => $this->size->getAllSizepacks(),
                            'vendor'        => DB::table('vendors')->select([
                                'id',
                                'vendor_name',
                            ])->get(),
                            //                            'prefix_mou'    => config('ordertype.mou_type'),
                            'prefix_mou'    => config('ordertype.mou_type'),
                            'artwork'       => DB::table('artworks')->select([
                                'id',
                                'name',
                            ])->get(),
                            'artwork_size'  => DB::table('artwork_size')->get(),
                            'artwork_print' => DB::table('product_artwork_print_types')
                                                 ->get(),
                            'sessions'      => $session_data['steps'],
                        ];

                        return view('sales-officer.order-form.step-2')->with($compact);
                        break;
                    case 3:
                        $compact = [
                            'material_data'    => $this->product->getAllProductHasMaterialStocks($session_data['product_id']),
                            //                        'accessories_data' => $this->product->getAllSpecificationItems($session_data['product_id']),
                            'accessories_data' => $this->product->filterProductHasSpecificationItemsBy('product_id',
                                $session_data['product_id']),
                            'washing'          => $this->product->filterAddonsBy('slug_name',
                                'washing'),
                            'sessions'         => $session_data['steps'],
                        ];

//                        dd($compact);

                        return view('sales-officer.order-form.step-3')->with($compact);
                        break;
                    case 4:
                        $compact = [
                            'sessions' => $session_data['steps'],
                        ];

                        return view('sales-officer.order-form.step-4')->with($compact);
                        break;
                    case 5:

                        $compact = [
                            'orders'             => $this->order->getOrderDetail($session_data['order_id']),
                            'order_items'        => $this->order->getItemDetail($session_data['order_item_id']),
                            'order_item_sizes'   => $this->order->filterSizesBy('order_item_id',
                                $session_data['order_id']),
                            'order_adjust_price' => $this->order->filterAdjustPricesBy('order_item_id',
                                $session_data['order_item_id']),
                            'customers'          => $this->customer->getCustomerDetail($session_data['customer_id']),
                            'custom_design'      => $this->order->filterCustomArtworksBy('order_item_id',
                                $session_data['order_item_id']),
                            'artworks'           => $this->order->filterArtworksBy('order_item_id',
                                $session_data['order_item_id']),
                            //                            'custom_artworks'    => $this->order->filterCustomArtworksBy('order_item_id', $session_data['order_id']),
                            'custom_artworks'    => DB::table('order_item_cust_artworks')
                                                      ->where('order_item_id',
                                                          $session_data['order_id'])
                                                      ->get(),
                            'materials'          => $this->order->filterMaterialsBy('order_item_id',
                                $session_data['order_item_id']),
                            'material_spec'      => $this->product->getAllProductHasMaterialStocks($session_data['order_item_id']),
                            'accessories'        => $this->order->filterAccessoriesBy('order_item_id',
                                $session_data['order_item_id']),
                            'sizepacks'          => $this->size->filterSizepacksBy('id',
                                $this->order->filterItemsBy('order_id',
                                    $session_data['order_id'])
                                            ->pluck('sizepack_id')[0]),
                            'session_data'       => $session_data,
                        ];

//                        dd($compact);


                        //                        dd($compact);
                        return view('sales-officer.order-form.step-5')->with($compact);
                        break;
                    default:
                        return abort(404);
                        break;
                }
            }

            Session::forget('form-data');

            $session_data['steps'] = 1;
            Session::put('form-data', $session_data);

            $compact = [
                'customers'       => $this->customer->getAllCustomers(),
                'customer_prefix' => config('general.customer_prefix_id'),
                'sessions'        => $session_data['steps'],
                'categories'      => $this->category->getAllCategories(),
            ];

            return view('sales-officer.order-form.index')->with($compact);
        }

        public function step_1(Request $request, Order $order, Size $size)
        {
            $request_validation = [
                'session'        => 'required',
                'customer_id'    => 'required|numeric',
                'category_id'    => 'required|numeric',
                'subcategory_id' => 'required|numeric',
                'product_id'     => 'required|numeric',
                'size_id'        => 'required',
                'size_type_id'   => 'required',
                'qty'            => 'required',
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
                'qty',

            ];
            $data     = Arr::only($request->all(), $required);

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
            $data_set     = [
                'customer_id'    => $data['customer_id'],
                'payment_method' => 1,
                'payment_type'   => 2,
                'order_date'     => now(),
                'last_step'      => $data['session'],
                'last_step_date' => now(),
                'created_at'     => now(),
            ];
            $order_insert = $this->order->createOrder($data_set);

            if ( ! $order_insert) {
                throw new ApplicationException('Data Cannot be inserted, please try again');
            }

            // Step 2 - Order Item Insertion
            $order_item_param  = [
                'order_id'   => $order_insert,
                'product_id' => $data['product_id'],
                'order_date' => now(),
            ];
            $order_item_insert = $this->order->createItem($order_item_param);

            $quantity_total = 0;
            if ( ! empty($data['size_id'])) {

                foreach ($data['size_id'] as $key => $size_item) {
                    $sizeData = DB::table('sizes')->where('id', $size_item)
                                  ->get();
                    $sizeType = DB::table('size_types')
                                  ->where('id', $data['size_type_id'][$key])
                                  ->get();

                    $array = [
                        'order_item_id' => $order_insert,
                        'size_id'       => $sizeData[0]->id,
                        'size_type_id'  => $sizeType[0]->id,
                        'qty'           => $data['qty'][$key],
                        'amount'        => ! empty($sizeType[0]->extra_price)
                            ? $sizeType[0]->extra_price : 0,
                    ];

//                    dd($array);

                    $this->order->createSize($array);
                    $quantity_total += $data['qty'][$key];
                }

            }

            // Step 3 - Update Order Data
            $raw_data = [
                'total_item' => $quantity_total,
                'updated_at' => now(),
            ];
            $this->order->updateOrder($order_insert, $raw_data);

            //create new session to validate next process of foc...
            $sessions = [
                'steps'          => 2,
                'order_id'       => $order_insert,
                'order_item_id'  => $order_item_insert,
                'order_item_qty' => $quantity_total,
                'customer_id'    => $data['customer_id'],
                'product_id'     => $data['product_id'],
            ];

            Session::put('form-data', $sessions);

            DB::commit();

            $response = [
                'status'  => true,
                'code'    => 200,
                'data'    => [],
                'message' => 'OK',
            ];

            return response()->json($response);
        }

        public function step_2(Request $request)
        {
            $session_data  = Session::get('form-data');
            $request_param = [
                'session'                  => 'required|numeric',
                'data_order_priority'      => 'required|numeric|in:0,1',
                'data_customer_order_type' => 'required|numeric|in:1,2',
                'data_provider_order_type' => 'required|numeric|in:1,2',
                'data_sizepack'            => 'required|numeric',

                'f-payment'                    => 'required|numeric|in:0,1,2',
                'data_has_custom_label_upload' => 'required_if:f-payment,==,2',
                'data_has_custom_label_notes'  => 'nullable',

                'data_has_packaging'        => 'required|numeric|in:0,1',
                'data_has_packaging_upload' => 'required_if:data_has_packaging,==,1',
                'data_has_packaging_notes'  => 'nullable',

                'data_has_design'          => 'required|numeric|in:0,1',
                'data_has_design_title'    => 'required_if:data_has_design,==,1',
                'data_has_design_title.*'  => 'required_if:data_has_design,==,1',
                'data_has_design_upload'   => 'required_if:data_has_design,==,1',
                'data_has_design_upload.*' => 'required_if:data_has_design,==,1',

                'data_has_artwork'                 => 'required|numeric|in:0,1',
                'data_has_artwork_position'        => 'required_if:data_has_artwork,==,1',
                'data_has_artwork_position.*'      => 'required_if:data_has_artwork,==,1',
                'data_has_artwork_size'            => 'required_if:data_has_artwork,==,1',
                'data_has_artwork_size.*'          => 'required_if:data_has_artwork,==,1',
                'data_has_artwork_print_type'      => 'required_if:data_has_artwork,==,1',
                'data_has_artwork_print_type.*'    => 'required_if:data_has_artwork,==,1',
                'data_has_artwork_color_qty'       => 'required_if:data_has_artwork,==,1',
                'data_has_artwork_color_qty.*'     => 'required_if:data_has_artwork,==,1',
                'data_has_artwork_upload'          => 'required_if:data_has_artwork,==,1',
                'data_has_artwork_upload.*'        => 'required_if:data_has_artwork,==,1',
                'data_has_artwork_vector_upload'   => 'required_if:data_has_artwork,==,1',
                'data_has_artwork_vector_upload.*' => 'required_if:data_has_artwork,==,1',

                'data_has_design_reference'        => 'required_if:data_has_design,==,0|numeric|in:0,1',
                'data_has_design_reference_link'   => 'required_if:data_has_design_reference_upload,==,null',
                'data_has_design_reference_upload' => 'required_if:data_has_design_reference_link,==,null',

                'data_has_artwork_reference'        => 'required_if:data_has_artwork,==,0|numeric|in:0,1',
                'data_has_artwork_reference_link'   => 'required_if:data_has_artwork_reference_upload,==,null',
                'data_has_artwork_reference_upload' => 'required_if:data_has_artwork_reference_link,==,null',

                'data_customer_start_date'  => 'required',
                'data_customer_finish_date' => 'required',
                'data_vendor'               => 'required|numeric',
                'data_vendor_start_date'    => 'required',
                'data_vendor_finish_date'   => 'required',
                'data_order_notes'          => 'nullable',
            ];

            $this->validate($request, $request_param);


            // Get Required only in array
            $arr_only = [
                'session',
                'data_order_priority',
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
            $product_data
                = $this->product->getProductDetail($session_data['product_id']);

            //            dd($product_data);

            if ($product_data == null) {
                throw new ApplicationException('Product Data is Null');
            }

            // Step 4 - Get Order data
            $order_data
                = $this->order->getOrderDetail($session_data['order_id']);

            if ( ! $order_data) {
                throw new ApplicationException('Order Data is Null');
            }

            // Step 5 - Get Order Item Data
            $order_item_data
                = $this->order->getItemDetail($session_data['order_item_id']);

            if ( ! $order_item_data) {
                throw new ApplicationException('Order Item Data is Null');
            }

            // Step 6 - get Product Id
            $data['product_id'] = $product_data[0]->id;

            // Step 7 - if Label is selected custom, then upload the file
            if ($data['f-payment'] == '2') {
                $label_data
                    = FormValidation2::uploadOne($request->file('data_has_custom_label_upload'),
                    'upload_image/order/label',
                    'label_order_id_' . $order_data->pluck('id')[0] . uniqid());
                if ( ! empty($label_data)) {
                    $data['label_data'] = $label_data;
                }
            } else {
                $data['label_data'] = $data['f-payment'];
            }

            // Step 8 - If Package is Selected custom, then upload the file
            if ($data['data_has_packaging'] == '1') {
                $packaging_data
                    = FormValidation2::uploadOne($request->file('data_has_packaging_upload'),
                    'upload_image/order/packaging',
                    'packaging_order_id_' . $order_data->pluck('id')[0]
                    . uniqid());

                if ( ! empty($packaging_data)) {
                    $data['packaging_data'] = $packaging_data;
                }
            }

            // Step 9 - Update Order Data
            $order_item_update_raw = [
                'sizepack_id'               => $data['data_sizepack'],
                'priority'                  => $data['data_order_priority'],
                'cust_to_own_type'          => $data['data_customer_order_type'],
                'own_to_cust_type'          => $data['data_provider_order_type'],
                'is_custom_label'           => $data['f-payment'],
                'label_photo'               => $data['label_data'],
                'is_repackaging'            => $data['data_has_packaging'],
                'packaging_note'            => ! empty($data['data_has_packaging_notes'])
                    ? $data['data_has_packaging_notes'] : null,
                'packaging_photo'           => ! empty($data['packaging_data'])
                    ? $data['packaging_data'] : null,
                'design_note'               => ! empty($data['data_has_design_note'])
                    ? $data['data_has_design_note'] : null,
                'order_date'                => $data['data_customer_start_date'],
                'completed_date'            => $data['data_customer_finish_date'],
                'vendor_id'                 => $data['data_vendor'],
                'vendor_mou_date'           => $data['data_vendor_start_date'],
                'vendor_mou_completed_date' => $data['data_vendor_finish_date'],
                'note'                      => $data['data_order_notes'],
                'updated_at'                => Carbon::now(),
            ];

            DB::table('order_items')->where('order_id', $order_data[0]->id)
              ->update($order_item_update_raw);

            //Step 10 - if has custom_artwork, insert into order item artwork
            if ($data['data_has_design'] == '1') {

                foreach ($data['data_has_design_title'] as $key => $item) {
                    $array = [
                        'order_item_id' => $order_item_data->pluck('id')[0],
                        'title'         => $item,
                    ];

                    $image_data
                        = FormValidation2::uploadOne($request->file('data_has_design_upload')[$key],
                        'upload_image/order/design',
                        'design_order_id_' . $order_data->pluck('id')[0]
                        . uniqid());

                    $array['photo'] = $image_data;

                    $this->order->createCustomArtwork($array);
                }

            }

            // Step 11 - if has custom artwork, loop and insert
            if ($data['data_has_artwork'] == '1') {

                foreach ($data['data_has_artwork_position'] as $key => $item) {
                    $get_print_type = DB::table('product_artwork_print_types')
                                        ->where('id',
                                            $data['data_has_artwork_print_type'][$key])
                                        ->get();

                    $array = [
                        'order_item_id'    => $order_item_data->pluck('id')[0],
                        'artwork_size_id'  => $data['data_has_artwork_size'][$key],
                        'product_addon_id' => $data['data_has_artwork_print_type'][$key],
                        'color_qty'        => $data['data_has_artwork_color_qty'][$key],
                        'amount'           => ! empty($get_print_type->pluck('price')[0])
                            ? $get_print_type->pluck('price')[0] : 0,
                    ];

                    //                    dd($array);
                    $data_preview
                                            = FormValidation2::uploadOne($request->file('data_has_artwork_upload')[$key],
                        'upload_image/order/artwork',
                        'artwork_preview_order_id_'
                        . $order_data->pluck('id')[0] . uniqid());
                    $array['preview_image'] = $data_preview;

                    $data_zip
                                       = FormValidation2::uploadOne($request->file('data_has_artwork_vector_upload')[$key],
                        'upload_image/order/artwork',
                        'artwork_zip_order_id' . $order_data->pluck('id')[0]
                        . uniqid());
                    $array['zip_file'] = $data_zip;

                    $this->order->createArtwork($array);
                }
            }

            // Step 12 - Check any references
            if ($data['data_has_design_reference'] == 1) {
                if ( ! empty($data['data_has_design_reference_link'])) {

                    $data = [
                        'order_item_id' => $order_data->pluck('id')[0],
                        'title'         => 'Design Reference '
                                           . $order_data->pluck('id')[0],
                        'photo'         => $data['data_has_design_reference_link'],
                    ];

                    $create_new_cust_artwork
                        = $this->order->createCustomArtwork($data);

                    if ( ! $create_new_cust_artwork) {
                        throw new ApplicationException('Failed to insert design reference link data to Order Item Cust Customer, Please check and try again');
                    }
                }

                if ( ! empty($data['data_has_design_reference_upload'])) {

                    $reference_upload
                        = FormValidation2::uploadOne($request->file('data_has_design_reference_upload'),
                        'upload_image/order/design',
                        'design_reference_order_id_'
                        . $order_data->pluck('id')[0] . uniqid());

                    $data = [
                        'order_item_id' => $order_data->pluck('id')[0],
                        'title'         => 'Design Reference '
                                           . $order_data->pluck('id')[0],
                        'photo'         => $reference_upload,
                    ];

                    $create_new_cust_artwork
                        = $this->order->createCustomArtwork($data);

                    if ( ! $create_new_cust_artwork) {
                        throw new ApplicationException('Failed to insert design reference photo data to Order Item Cust Customer, Please check and try again');
                    }
                }
            }

            if ($request->data_has_artwork_reference == '1') {
                if ( ! empty($request->data_has_artwork_reference_link)) {
                    $data = [
                        'order_item_id' => $order_data->pluck('id')[0],
                        'title'         => 'Customer Reference '
                                           . $order_data->pluck('id')[0],
                        'photo'         => $request->data_has_artwork_reference_link,
                    ];

                    $create_new_cust_artwork
                        = $this->order->createCustomArtwork($data);

                    if ( ! $create_new_cust_artwork) {
                        throw new ApplicationException('Failed to insert artwork reference link data to Order Item Cust Customer, Please check and try again');
                    }
                }

                if ( ! empty($request->data_has_artwork_reference_upload)) {

                    $reference_upload
                        = FormValidation2::uploadOne($request->file('data_has_artwork_reference_upload'),
                        'upload_image/order/artwork',
                        'artwork_reference_order_id_'
                        . $order_data->pluck('id')[0] . uniqid());


                    $data = [
                        'order_item_id' => $order_data->pluck('id')[0],
                        'title'         => 'Customer Reference '
                                           . $order_data->pluck('id')[0],
                        'photo'         => $reference_upload,
                    ];


                    $create_new_cust_artwork
                        = $this->order->createCustomArtwork($data);

                    if ( ! $create_new_cust_artwork) {
                        throw new ApplicationException('Failed to insert artwork reference photo data to Order Item Cust Customer, Please check and try again');
                    }
                }
            }

            // Step 13 - Update Last step
            $step_param = [
                'last_step'      => 2,
                'last_step_date' => now(),
            ];

            $this->order->updateOrder($order_data[0]->id, $step_param);

            $get_session['steps'] = 3;
            Session::put('form-data', $get_session);

            DB::commit();

            //passing or return true result...
            return response()->json([
                'status'  => true,
                'data'    => [],
                'message' => 'Berhasil menambahkan data pesanan',
            ], 200);
        }

        public function step_3(Request $request)
        {
            $session_data = Session::get('form-data');

            $request_param = [
                'session'               => 'required|numeric|in:3',
                'data_access_chooser'   => 'required',
                'data_access_chooser.*' => 'required_with:data_access_chooser',
                'data_access_type'      => 'required',
                'data_access_type.*'    => 'required_with:data_access_type',
                'data_has_washing'      => 'required|numeric|in:0,1',
                'data_washing_type'     => 'required_if:data_has_washing,==,1',
                'data_access_notes'     => 'nullable',
            ];

            $request->validate($request_param);

            $array_only = [
                'session',
                'data_access_chooser',
                'data_access_type',
                'data_has_washing',
                'data_washing_type',
                'data_access_notes',
            ];

            $data = Arr::only($request->all(), $array_only);

            // Begin Transaction

            DB::beginTransaction();

            if ($data['session'] != '3') {
                throw new ApplicationException('Data Session tidak sesuai, silakan muat ulang dan coba kembali');
            }

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

            $get_session = $session_data;
            if (empty($get_session)) {
                throw new ApplicationException('Data Session kosong, silakan muat ulang dan coba kembali');

            }

            $order_data
                = $this->order->getOrderDetail($get_session['order_id']);

            if (empty($order_data)) {
                throw new ApplicationException('Data Order kosong, silakan muat ulang dan coba kembali');
            }

            $order_item_data
                = $this->order->getItemDetail($get_session['order_item_id']);

            if (empty($order_item_data)) {
                throw new ApplicationException('Data Order Item kosong, silakan muat ulang dan coba kembali');
            }

            // Store Material
            $product_material_stocks
                = $this->product->getAllProductHasMaterialStocks($get_session['product_id']);

            foreach ($product_material_stocks as $key => $item) {
                $get_material_spec_items
                    = $this->product->getAllProductHasSpecificationItems($item->product_id);
                foreach ($get_material_spec_items as $item_b) {

                    $array = [
                        'order_item_id'             => $get_session['order_item_id'],
                        'material_stock_id'         => $item->material_stock_id,
                        'material_specification_id' => $item_b->product_specification_id,
                        'qty'                       => 1,
                        'amount'                    => 0,
                    ];

                    $this->order->createMaterial($array);
                }
            }

            // Store Accessories
            if ( ! empty($data['data_access_chooser'])) {
                foreach ($data['data_access_chooser'] as $key => $item) {
                    $get_product_item
                        = $this->product->getAllSpecificationItems($data['data_access_type'][$key]);

                    $array = [
                        'order_item_id'            => $get_session['order_item_id'],
                        'product_specification_id' => $data['data_access_type'][$key],
                        'qty'                      => 1,
                        'amount'                   => ! empty($get_product_item[0]->price)
                            ? $get_product_item[0]->price : 0,
                        'note'                     => $data['data_access_notes'][$key],
                    ];

                    $this->order->createAccessories($array);
                }

            }

            // Washing
            if ( ! empty($data['data_has_washing'])
                 && ! empty($data['data_washing_type'])
            ) {
                $param = [
                    'is_washing' => $request->data_has_washing,
                    'washing_id' => $data['data_washing_type'],
                ];

                DB::table('order_items')->where('id', $order_item_data[0]->id)
                  ->update($param);
            }

            // Updating Last step
            $param = [
                'last_step'      => '3',
                'last_step_date' => now(),
            ];

            $this->order->updateOrder($order_data[0]->id, $param);

            $get_session['steps'] = 4;
            Session::put('form-data', $get_session);

            DB::commit();

            $response = [
                'status'  => true,
                'code'    => 200,
                'data'    => [],
                'message' => 'OK',
            ];

            return response()->json($response);
        }

        public function step_4(Request $request)
        {
            $session_data  = Session::get('form-data');
            $request_param = [
                'session'             => 'required|numeric|in:4',
                'data_price_title'    => 'required',
                'data_price_title.*'  => 'required_with:data_price_title',
                'data_price_amount'   => 'required',
                'data_price_amount.*' => 'required_with:data_price_amount',
                'data_price_qty'      => 'required',
                'data_price_qty.*'    => 'required_with:data_price_qty',
                'f-payment'           => 'required|numeric|in:0,1',
                'f-payment-type'      => 'required|numeric|in:0,1',
                'data_payment_amount' => 'required_if:f-payment,==,1',
            ];

            $request->validate($request_param);

            $array_only = [
                'session',
                'data_price_title',
                'data_price_amount',
                'data_price_qty',
                'f-payment',
                'f-payment-type',
                'data_payment_type',
            ];
            $data       = Arr::only($request->all(), $array_only);

            // Begin Transaction
            DB::beginTransaction();

            if ( ! $data['session'] == '4') {
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


            $product_data
                = $this->product->getProductDetail($session_data['product_id']);

            if (empty($product_data)) {
                throw new ApplicationException('Produk tidak ditemukam, silakan coba kembali');
            }


            $order_data
                = $this->order->getOrderDetail($session_data['order_id']);

            if (empty($order_data)) {
                throw new ApplicationException('Order Data tidak ditemukan, silakan coba kembali');
            }


            $order_item_data
                = $this->order->getItemDetail($session_data['order_item_id']);

            if (empty($order_item_data)) {
                throw new ApplicationException('Order Item Data Kosong, Silakan coba kembali');
            }

            // Save Adjust Price
            if ( ! empty($data['data_price_title'])) {
                foreach ($data['data_price_title'] as $key => $price_title_item)
                {
                    $array = [
                        'order_item_id' => $order_item_data[0]->id,
                        'adjust_amount' => ($data['data_price_amount'][$key]
                                            * $data['data_price_qty'][$key]),
                        'note'          => $price_title_item,
                    ];

                    $this->order->createAdjustPrice($array);
                }
            }

            // Get Al Prices
            $sum_size_amount  = $this->order->filterSizesBy('order_item_id',
                $order_data[0]->id);
            $sum_adj_price_amount
                              = $this->order->sumAdjustPrice($order_item_data[0]->id);
            $sum_accs_amount
                              = $this->order->sumAccessories($order_data[0]->id);
            //            $sum_addon_amount = $this->order->sumAddons($order_data[0]->id);
            $sum_artwork_amount
                              = $this->order->sumArtwork($order_data[0]->id);
            $sum_material_amount
                              = $this->order->sumMaterial($order_data[0]->id);

            // Do Calculation
            $calc_array = [
                $sum_accs_amount,
                //                $sum_addon_amount,
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

            // Down Payment
            if ($data['f-payment'] == '0') {
                $data['total_payment']              = $total_product_price;
                $session_data['payment_percentage'] = 0;
            }

            if ($data['f-payment'] == '1') {
                if ($data['f-payment-type'] == '1') {
                    $sub                                = (intval($request->data_payment_amount)
                                                           / 100)
                                                          * $total_product_price;
                    $data['total_payment']              = $sub;
                    $session_data['payment_percentage'] = 0;
                }
                if ($data['f-payment-type'] == '1'
                    && intval($request->data_payment_amount) >= 100
                ) {
                    $sub                                = (intval($request->data_payment_amount)
                                                           / $total_product_price)
                                                          * 100;
                    $data['total_payment']
                                                        = $request->data_payment_amount;
                    $session_data['payment_percentage'] = round($sub, 1);
                }
                if ($data['f-payment-type'] == '0') {
                    $data['total_payment']              = $request->data_payment_amount;
                    $session_data['payment_percentage'] = 0;
                }
            }

            // Update total amount
            $session_data['total_payment_data'] = (intval($sum_adj_price_amount)
                                                   + intval($total_product_price));

            // Update Param
            $param = [
                'last_step'        => 4,
                'last_step_date'   => now(),
                'total_amount'     => $total_product_price,
                'part_paid_amount' => $data['total_payment'],
            ];
            $this->order->updateOrder($order_data[0]->id, $param);

            $session_data['payment_method'] = $data['f-payment'];

            $params = [
                'product_price'      => $product_data[0]->price,
                'sum_size_price'     => $sum_size_amount,
                'sum_accs_price'     => $sum_accs_amount,
                //                'sum_addon_price'    => $sum_addon_amount,
                'sum_adj_price'      => $sum_adj_price_amount,
                'sum_artworks_price' => $sum_artwork_amount,
                'sum_material_price' => $sum_material_amount,
            ];
            DB::table('order_items')->where('id', $order_item_data[0]->id)
              ->update($params);

            $session_data['steps'] = 5;
            Session::put('form-data', $session_data);

            DB::commit();

            $message = [
                'status'  => true,
                'code'    => 200,
                'data'    => [],
                'message' => 'OK',
            ];

            return response()->json($message);
        }

        public function step_5(Request $request)
        {
            $session_data = Session::get('form-data');

            $order_data
                = $this->order->getOrderDetail($session_data['order_id']);

            DB::beginTransaction();

            // Update Order
            $param = [
                'order_status_id' => 1,
                'last_step'       => 5,
                'last_step_date'  => now(),
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
    }

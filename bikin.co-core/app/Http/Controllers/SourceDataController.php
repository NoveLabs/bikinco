<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

//    use App\Repositories\Product\Product;
//    use App\Repositories\Customer\Customer;
//    use App\Repositories\Order\Order;
//    use App\Repositories\Artwork\Artwork;
//    use App\Repositories\Size\Size;
//    use App\Repositories\Category\Category;

    use App\Services\ProductService as Product;
    use App\Services\CustomerService as Customer;
    use App\Services\OrderService as Order;
    use App\Services\ArtworkService as Artwork;
    use App\Services\SizeService as Size;
    use App\Services\CategoryService as Category;
    use App\Services\SubcategoryService as Subcategory;
    use App\Services\CityService as City;
    use Illuminate\Support\Facades\DB;

    class SourceDataController extends Controller
    {
        // Private Variables
        private $product;
        private $customer;
        private $order;
        private $artwork;
        private $size;
        private $category;
        private $subcategory;
        private $city;

        public function __construct()
        {
            $this->product = new Product;
            $this->customer = new Customer;
            $this->order = new Order;
            $this->artwork = new Artwork;
            $this->size = new Size;
            $this->category = new Category;
            $this->subcategory = new Subcategory;
            $this->city = new City;
        }

        public function customerDetail($id)
        {
            $customer_data = $this->customer->filterCustomersWhere('id', $id);
            $cluster = $this->customer->filterClustersWhere('id', $customer_data->pluck('work_id')[0]);
            $cities = $this->city->filterCitiesWhere('id', $customer_data->pluck('cities_id')[0]);
            $province = DB::table('provinces')->where('id', $cities->pluck('province_id')[0])->get();

            $response = [
                'status'  => true,
                'code'    => 200,
                'data'    => [
                    'customers' => $customer_data,
                    'cluster' => $cluster,
                    'cities' => $cities,
                    'province' => $province,
                ],
                'message' => 'OK',
            ];


            return response()->json($response);
        }

        public function subcategoryList($id)
        {
            $subcategory = $this->subcategory->filterSubcatsWhere('categories_id', $id);

            $response = [
                'status'  => true,
                'code'    => 200,
                'data'    => [
                    'subcategory' => $subcategory,
                ],
                'message' => 'OK',
            ];

            return response()->json($response);
        }

        public function productList($id)
        {
            $products = $this->product->filterProductsWhere('sub_categories_id', $id);

            $response = [
                'status'  => true,
                'code'    => 200,
                'data'    => [
                    'product' => $products,
                ],
                'message' => 'OK',
            ];

            return response()->json($response);
        }

        public function sizeList($id)
        {
            $sizes = $this->size->filterSizesWhere('categories_id', $id);

            $response = [
                'status'  => true,
                'code'    => 200,
                'data'    => [
                    'size' => $sizes,
                ],
                'message' => 'OK',
            ];


            return response()->json($response);
        }

        public function sizeTypeList($id)
        {
            $sizeType = $this->size->filterSizeTypesWhere('categories_id', $id);

            $response = [
                'status'  => true,
                'code'    => 200,
                'data'    => [
                    'size_type' => $sizeType,
                ],
                'message' => 'OK',
            ];

            return response()->json($response);
        }

        public function artworkSizeList($id)
        {
            $artwork_size_param = [
                'artwork_size.id',
                'artwork_size.size',
            ];

            $artwork_size = $this->artwork->getAllArtworkSizes();

            $response = [
                'status'  => true,
                'code'    => 200,
                'data'    => [
                    'artwork_size' => $artwork_size,
                ],
                'message' => 'OK',
            ];

            return response()->json($response);
        }

        public function productSpecList($id)
        {

            $data = $this->product->filterProductSpecItemsWhere('product_specification_id', $id);

            $response = [
                'status'  => true,
                'code'    => 200,
                'data'    => [
                    'product_spec_item' => $data,
                ],
                'message' => 'OK',
            ];

            return response()->json($response);
        }

        public function productSpecPriceList($id)
        {
            $data = $this->product->filterProductSpecItemsWhere('id', $id);

            $response = [
                'status'  => true,
                'code'    => 200,
                'data'    => [
                    'spec_price' => $data,
                ],
                'message' => 'OK',
            ];

            return response()->json($response);
        }

    }

<?php

namespace App\Http\Controllers;

use App\Services\ArtworkService as Artwork;
use App\Services\CategoryService as Category;
use App\Services\CityService as City;
use App\Services\CustomerService as Customer;
use App\Services\OrderService as Order;
use App\Services\ProductService as Product;
use App\Services\SizeService as Size;
use App\Services\SubcategoryService as Subcategory;
use App\Services\VendorService as Vendor;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VendorDocsPrintableController extends Controller
{
    // Private Variables
    private $artwork;
    private $category;
    private $city;
    private $customer;
    private $order;
    private $product;
    private $size;
    private $subcategory;
    private $vendor;

    // Constructor
    public function __construct()
    {
        $this->artwork = new Artwork();
        $this->category = new Category();
        $this->city = new City();
        $this->customer = new Customer();
        $this->order = new Order();
        $this->product = new Product();
        $this->size = new Size();
        $this->subcategory = new Subcategory();
        $this->vendor = new Vendor();
    }

    public function billOfMaterial(Request $request, $id)
    {
        $orders = $this->order->filterOrdersWhere('id', $id);
        $order_items = $this->order->filterItemsWhere('id', $orders[0]->id);
        $order_item_sizes = $this->order->filterSizesWhere('order_item_id', $order_items[0]->id);
        $order_adjust_price = $this->order->filterAdjPricesWhere('order_item_id', $order_items[0]->id);
        $customers = $this->customer->filterCustomersWhere('id', $orders[0]->customer_id);
        $designs = $this->order->filterCustArtworksWhere('order_item_id', $order_items[0]->id);
        $custom_design = $this->order->filterCustArtworksWhere('order_item_id', $order_items[0]->id);
        $artworks = $this->order->filterArtworksWhere('order_item_id', $order_items[0]->id);
        //
        $custom_artworks = $this->order->filterDesignsWhere('order_item_id', $order_items[0]->id);
        $materials = $this->order->filterMaterialsWhere('order_item_id', $order_items[0]->id);
        $material_spec = $this->product->filterProductHasMaterialStocksWhere('product_id', $order_items[0]->product_id);
        $accessories = $this->order->filterAccessoriesWhere('order_item_id', $order_items[0]->id);
        $sizepacks = $this->size->filterSizepacksWhere('id', $order_items[0]->sizepack_id);
        $cities = $this->city->filterCitiesWhere('id', $customers[0]->cities_id);
        $province = DB::table('provinces')->where('id', $cities[0]->province_id)->get();
        $products = $this->product->filterProductsWhere('id', $order_items[0]->product_id);
        $vendors = $this->vendor->filterVendorsWhere('id', $order_items[0]->vendor_id);
        $product_addons = $this->product->filterProductAddonsWhere('id', $order_items[0]->is_washing);

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
                $materials[$key]->material_color_id)->get();
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

        $supplier_data = [];
        foreach ($stage_1_array as $key => $item) {
            $data = DB::table('suppliers')->where('id', $item[0]->supplier_id)->get();
            array_push($supplier_data, $data);
        }

        $size_data = [];
        foreach ($stage_1_array as $item) {
            $data = DB::table('units')->where('id', $item[0]->unit_id)->get();
            array_push($size_data, $data);
        }

        $subcategory_data = $this->subcategory->filterSubcatsWhere('id', $products[0]->sub_categories_id);
        $category_data = $this->category->filterCategoriesWhere('id', $subcategory_data[0]->categories_id);



        $compact = [
            'orders' => $orders,
            'order_items' => $order_items,
            'order_item_sizes' => $order_item_sizes,
            'order_adjust_price' => $order_adjust_price,
            'categories' => $category_data,
            'subcategories' => $subcategory_data,
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
            'cities' => $cities,
            'province' => $province,
            'products' => $products,
            'sizes' => $stage_6_array,
            'size_types' => $stage_7_array,
            'material_stock' => $stage_1_array,
            'material_size' => $size_data,
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
            'vendors' => $vendors,
            'product_addons' => !empty($product_addons) ? $product_addons : '',
            'suppliers' => $supplier_data,
        ];

        if ($request->action == 'export') {

            return PDF::loadView('document-exports.exports.vendor-bill-material-export', $compact)->setPaper('a4')
                    ->download('Bill-Of-Material-BP-' . $orders[0]->id . '.pdf');

        } else {

//            return dd($compact);
            return view('document-exports.exports.vendor-bill-material-export')->with($compact);

        }

        return abort(404);
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

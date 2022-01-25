<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use App\Http\Models\Customer;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use SoftDeletes;

    public $table = "orders";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $guarded = [
    ];

    public function getAllData()
    {
        return Order::with('hasCustomer')
            ->whereNull('deleted_at')
            ->get();
    }

    public function scopeGetDataPayments($query)
    {
        return $query->select([
              'orders.id',
              'orders.customer_id',
              'orders.payment_method',
              'orders.payment_type',
              'orders.part_paid_amount',
              'orders.created_at as tgl_order',
              'orders.total_item',
              'order_payments.proof_payment as proof_payment_name',
              queryFormatPhotoWithAlias('order_payments.proof_payment', 'orderpaymentpath',[''=>'proof_payment','sm'=>'proof_payment_sm','xs'=>'proof_payment_xs']),
              'order_payments.id as id_order_payment',
              'order_payments.order_id',
              'order_payments.type',
              'order_payments.status',
              'order_payments.is_dp',
              'order_payments.payment_total',
              'order_items.priority',
              'products.name',
              \DB::raw('DATE_FORMAT(order_payments.created_at, "%d-%b-%Y")  as tgl_payment'),
              'order_payment_logs.order_payment_id',
               queryFormatPhotoWithAlias('order_payment_logs.proof_payment', 'orderpaymentpath',[''=>'proof_payment','sm'=>'proof_payment_sm','xs'=>'proof_payment_xs']),
              'order_payment_logs.type as log_type',
              'order_payment_logs.status as log_status',
              'order_payment_logs.is_dp as log_is_dp',
              'order_payment_logs.reason as log_reason',
              \DB::raw('DATE_FORMAT(order_payment_logs.created_at, "%d-%b-%Y")  as log_created_at'),
              \DB::raw('DATE_FORMAT(order_payment_logs.created_at, "%h:%i")  as log_created_time'),
              'customers.fullname'
            ])
        ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
        ->leftjoin('products', 'products.id', '=', 'order_items.product_id')
        ->leftJoin('order_payments', 'order_payments.order_id', '=', 'orders.id')
        ->leftJoin('order_payment_logs', 'order_payments.id', '=', 'order_payment_logs.order_payment_id')
        ->leftJoin('customers', 'customers.id', '=', 'orders.customer_id')
        ->Where('order_payments.status', 3)
        ->where('orders.flow_step', 2)
        ->whereRaw('order_payment_logs.id IN (select max(order_payment_logs.id) from order_payment_logs group by order_payment_id)')
        ->orderBy('order_payment_logs.created_at', 'DESC')
        ;
    }

    public function scopeGetDataPaymentsAll($query)
    {
        return $query->select([
              'orders.id',
              'orders.customer_id',
              'orders.payment_method',
              'orders.payment_type',
              'orders.total_item',
              'orders.part_paid_amount',
              \DB::raw('DATE_FORMAT(orders.created_at, "%d %b %Y") as tgl_order'),
              queryFormatPhotoWithAlias('order_payments.proof_payment', 'orderpaymentpath',[''=>'proof_payment','sm'=>'proof_payment_sm','xs'=>'proof_payment_xs']),
              'order_payments.id as id_order_payment',
              'order_payments.order_id',
              'order_payments.type',
              'order_payments.status',
              'order_payments.is_dp',
              'order_payments.payment_total',
              'order_items.priority',

              'products.name',
              \DB::raw('DATE_FORMAT(order_payments.created_at, "%d-%b-%Y")  as tgl_payment'),
              'order_payment_logs.order_payment_id',
              queryFormatPhotoWithAlias('order_payment_logs.proof_payment', 'orderpaymentpath',[''=>'proof_payment','sm'=>'proof_payment_sm','xs'=>'proof_payment_xs']),
              'order_payment_logs.type as log_type',
              'order_payment_logs.status as log_status',
              'order_payment_logs.is_dp as log_is_dp',
              'order_payment_logs.reason as log_reason',
              \DB::raw('DATE_FORMAT(order_payment_logs.created_at, "%d-%b-%Y")  as log_created_at'),
              \DB::raw('DATE_FORMAT(order_payment_logs.created_at, "%h:%i")  as log_created_time'),
              'customers.fullname'
            ])
        ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
        ->leftjoin('products', 'products.id', '=', 'order_items.product_id')
        ->leftJoin('order_payments', 'order_payments.order_id', '=', 'orders.id')
        ->leftJoin('order_payment_logs', 'order_payments.id', '=', 'order_payment_logs.order_payment_id')
        ->leftJoin('customers', 'customers.id', '=', 'orders.customer_id')
        ->whereNull('order_payments.status')
        ->where('orders.flow_step', 1)
        ->orWhere('order_payments.is_dp', 2)
        ->whereRaw('order_payment_logs.id IN (select max(order_payment_logs.id) from order_payment_logs group by order_payment_id)')
        ->orderBy('order_payment_logs.created_at', 'DESC')
        ;
    }

    public function scopeGetDataPaymentsPelunasan($query)
    {
        return $query->select([
              'orders.id',
              'orders.customer_id',
              'orders.payment_method',
              'orders.payment_type',
              'orders.part_paid_amount',
              'orders.created_at as tgl_order',
              'orders.total_amount',
              'orders.total_item',
              queryFormatPhotoWithAlias('order_payments.proof_payment', 'orderpelunasanpath',[''=>'proof_payment','sm'=>'proof_payment_sm','xs'=>'proof_payment_xs']),
              'order_payments.id as id_order_payment',
              'order_payments.order_id',
              'order_payments.type',
              'order_payments.status',
              'order_payments.is_dp',
              'order_payments.payment_total',
              'order_items.priority',
              'products.name',
              \DB::raw('DATE_FORMAT(order_payments.created_at, "%d-%b-%Y")  as tgl_payment'),
              'order_payment_logs.order_payment_id',
              queryFormatPhotoWithAlias('order_payment_logs.proof_payment', 'orderpelunasanpath',[''=>'proof_payment','sm'=>'proof_payment_sm','xs'=>'proof_payment_xs']),
              'order_payment_logs.type as log_type',
              'order_payment_logs.status as log_status',
              'order_payment_logs.is_dp as log_is_dp',
              'order_payment_logs.reason as log_reason',
              \DB::raw('DATE_FORMAT(order_payment_logs.created_at, "%d-%b-%Y")  as log_created_at'),
              \DB::raw('DATE_FORMAT(order_payment_logs.created_at, "%h:%i")  as log_created_time'),
              'customers.fullname'
            ])
        ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
        ->leftjoin('products', 'products.id', '=', 'order_items.product_id')
        ->join('order_payments', 'order_payments.order_id', '=', 'orders.id')
        ->join('order_payment_logs', 'order_payments.id', '=', 'order_payment_logs.order_payment_id')
        ->join('customers', 'customers.id', '=', 'orders.customer_id')
        ->whereIn('orders.flow_step', [7, 8])
        ->where('order_payments.type', 2)
        ->where('order_payments.is_dp', 1)
        ->whereRaw('order_payment_logs.id IN (select max(order_payment_logs.id) from order_payment_logs group by order_payment_id)')
        ->orderBy('order_payment_logs.created_at', 'DESC')
        ;
    }

    public function scopeGetDataPaymentsAccountingPelunasan($query)
    {
        return $query->select([
              'orders.id',
              'orders.customer_id',
              'orders.payment_method',
              'orders.payment_type',
              'orders.part_paid_amount',
              'orders.total_amount',
              'orders.total_item',
              'orders.created_at as tgl_order',
              'order_payments.proof_payment as proof_payment_name',
              queryFormatPhotoWithAlias('order_payments.proof_payment', 'orderpelunasanpath',[''=>'proof_payment','sm'=>'proof_payment_sm','xs'=>'proof_payment_xs']),
              'order_payments.id as id_order_payment',
              'order_payments.order_id',
              'order_payments.type',
              'order_payments.status',
              'order_payments.is_dp',
              'order_payments.payment_total',
              'order_items.priority',
              'products.name',
              \DB::raw('DATE_FORMAT(order_payments.created_at, "%d-%b-%Y")  as tgl_payment'),
              'order_payment_logs.order_payment_id',
              'order_payment_logs.proof_payment as log_gambar',
              'order_payment_logs.type as log_type',
              'order_payment_logs.status as log_status',
              'order_payment_logs.is_dp as log_is_dp',
              'order_payment_logs.reason as log_reason',
              \DB::raw('DATE_FORMAT(order_payment_logs.created_at, "%d-%b-%Y")  as log_created_at'),
              \DB::raw('DATE_FORMAT(order_payment_logs.created_at, "%h:%i")  as log_created_time'),
              'customers.fullname'
            ])
        ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
        ->leftjoin('products', 'products.id', '=', 'order_items.product_id')
        ->leftJoin('order_payments', 'order_payments.order_id', '=', 'orders.id')
        ->leftJoin('order_payment_logs', 'order_payments.id', '=', 'order_payment_logs.order_payment_id')
        ->leftJoin('customers', 'customers.id', '=', 'orders.customer_id')
        ->Where('order_payments.status', 3)
        ->where('orders.flow_step', 8)
        ->where('order_payments.is_dp',  1)
        ->where('order_payments.type', 2)
        ->whereRaw('order_payment_logs.id IN (select max(order_payment_logs.id) from order_payment_logs group by order_payment_id)')
        ->orderBy('order_payment_logs.created_at', 'DESC')
        ;
    }

    public function scopeGetDataArtworkDesign($query)
    {
        return $query->select([
              'orders.id',
              'orders.flow_step',

              'order_item_artworks.order_item_id as id_order_artwork',
              'order_item_artworks.id as id_artwork',
              'artwork_size.size',
              'material_specifications.name as name_material',
              'product_addons.name as name_product_addons',
              'order_item_artworks.color_qty as color_qty_artwork',
              'order_item_artworks.amount as amount_artwork',
              'order_item_artworks.preview_image as preview_image_artwork',
              'order_item_artworks.zip_file as zip_file_artwork',
              'products.name',

              'order_item_cust_artworks.order_item_id as id_order_design',
              'order_item_cust_artworks.id as id_design',
              'order_item_cust_artworks.title',
              'order_item_cust_artworks.getImagePelunasan as preview_image_design',

              'verifikasi_artwork_designs.status',
              'artworks.name as artwork_position',


              'customers.fullname',
              \DB::raw('DATE_FORMAT(orders.created_at, "%d-%b-%Y")  as tgl_order'),
            ])
        ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
        ->leftJoin('order_item_artworks', 'order_item_artworks.order_item_id', '=', 'order_items.id')
        ->leftJoin('order_item_cust_artworks', 'order_items.id', '=', 'order_item_cust_artworks.order_item_id')
        ->leftJoin('artwork_size', 'artwork_size.id', '=', 'order_item_artworks.artwork_size_id')
        ->leftJoin('artworks', 'artworks.id', '=', 'order_item_artworks.artwork_position')
        ->leftJoin('material_specifications', 'material_specifications.id', '=', 'order_item_artworks.material_specificiation_id')
        ->leftJoin('product_addons', 'product_addons.id', '=', 'order_item_artworks.product_addon_id')
        ->leftjoin('products', 'products.id', '=', 'order_items.product_id')
        ->leftJoin('customers', 'customers.id', '=', 'orders.customer_id')
        ->leftJoin('verifikasi_artwork_designs', 'verifikasi_artwork_designs.order_id', '=', 'orders.id')
        ->whereIn('verifikasi_artwork_designs.status', [1,2,3])
        ->where('orders.flow_step', 3)
        ->groupBy('orders.id')
        ;
    }

    public function scopeGetDataArtworkDesignPD($query)
    {
        return $query->select([
        'orders.id',

        'order_item_artworks.order_item_id as id_order_artwork',
        'order_item_artworks.id as id_artwork',
        'artwork_size.size',
        'material_specifications.name as name_material',
        'product_addons.name as name_product_addons',
        'products.name',
        'order_items.priority',
        'order_item_artworks.color_qty as color_qty_artwork',
        'order_item_artworks.amount as amount_artwork',
        'order_item_artworks.preview_image as preview_image_artwork',
        'order_item_artworks.zip_file as zip_file_artwork',
        'verifikasi_artwork_designs.status',
        'artworks.name as artwork_position',
        'customers.fullname',
        \DB::raw('DATE_FORMAT(orders.created_at, "%d-%b-%Y")  as tgl_order')])
        ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
        ->leftjoin('order_item_artworks', 'order_item_artworks.order_item_id', '=', 'order_items.id')
        ->leftJoin('artwork_size', 'artwork_size.id', '=', 'order_item_artworks.artwork_size_id')
        ->leftJoin('artworks', 'artworks.id', '=', 'order_item_artworks.artwork_position')
        ->leftjoin('material_specifications', 'material_specifications.id', '=', 'order_item_artworks.material_specificiation_id')
        ->leftjoin('product_addons', 'product_addons.id', '=', 'order_item_artworks.product_addon_id')
        ->leftjoin('products', 'products.id', '=', 'order_items.product_id')
        ->leftjoin('customers', 'customers.id', '=', 'orders.customer_id')
        ->leftjoin('verifikasi_artwork_designs', 'verifikasi_artwork_designs.order_id', '=', 'orders.id')
        ->whereIn('verifikasi_artwork_designs.status', [1,2])
        ->where('orders.flow_step', 3)
        ->groupBy('orders.id')
        ;
    }

    public function scopeGetDataArtworkById($query, $id)
    {
        return $query->select([
          'orders.id',

          'order_item_artworks.order_item_id as id_order_artwork',
          'order_item_artworks.id as id_artwork',
          'artwork_size.size',
          'artwork_print_types.name as name_material',
          'artwork_print_methods.name as name_printing',
          'product_addons.name as name_product_addons',
          'order_item_artworks.color_qty as color_qty_artwork',
          'order_item_artworks.amount as amount_artwork',
          queryFormatPhotoWithAlias('order_item_artworks.preview_image', 'artworkpath',[''=>'artwork','sm'=>'artwork_sm','xs'=>'artwork_xs']),
          queryFormatPhotoWithAlias('order_item_artworks.zip_file', 'zipartworkpath',[''=>'zip_file']),
          'order_item_artworks.amount',
          'artworks.name as artwork_position',
          'order_item_artworks.artwork_position as position_id',
          'order_item_artworks.artwork_size_id as id_size',
          'order_item_artworks.artwork_method_id as id_method',
          'order_item_artworks.artwork_print_type_id as id_type',
          \DB::raw('DATE_FORMAT(orders.created_at, "%d-%b-%Y")  as tgl_order'),
          'customers.fullname',

          ])
        ->join('order_items', 'order_items.order_id', '=', 'orders.id')
        ->join('order_item_artworks', 'order_item_artworks.order_item_id', '=', 'order_items.id')
        ->leftJoin('artwork_size', 'artwork_size.id', '=', 'order_item_artworks.artwork_size_id')
        ->join('artworks', 'artworks.id', '=', 'order_item_artworks.artwork_position')
        ->join('artwork_print_types', 'artwork_print_types.id', '=', 'order_item_artworks.artwork_print_type_id')
        ->join('artwork_print_methods', 'artwork_print_methods.id', '=', 'order_item_artworks.artwork_method_id')
        ->leftJoin('product_addons', 'product_addons.id', '=', 'order_item_artworks.product_addon_id')
        ->join('customers', 'customers.id', '=', 'orders.customer_id')
        ->where('orders.id', '=', $id)->get();
    }

    public function getDataArtworkByIdSum($id)
    {
        return Order::select([
          'orders.id',

          'order_item_artworks.order_item_id as id_order_artwork',
          'order_item_artworks.id as id_artwork',
          'artwork_size.size',
          'material_specifications.name as name_material',
          'product_addons.name as name_product_addons',
          'order_item_artworks.color_qty as color_qty_artwork',
          'order_item_artworks.amount as amount_artwork',
          'order_item_artworks.preview_image as preview_image_artwork',
          'order_item_artworks.zip_file as zip_file_artwork',
          'order_item_artworks.amount',
          'customers.fullname',
          \DB::raw('DATE_FORMAT(orders.created_at, "%d-%b-%Y")  as tgl_order'),
          \DB::raw('SUM(order_item_artworks.amount) as amount_harga'),

          ])
        ->join('order_items', 'order_items.order_id', '=', 'orders.id')
        ->join('order_item_artworks', 'order_item_artworks.order_item_id', '=', 'order_items.id')
        ->leftJoin('artwork_size', 'artwork_size.id', '=', 'order_item_artworks.artwork_size_id')
        ->join('material_specifications', 'material_specifications.id', '=', 'order_item_artworks.material_specificiation_id')
        ->join('product_addons', 'product_addons.id', '=', 'order_item_artworks.product_addon_id')
        ->join('customers', 'customers.id', '=', 'orders.customer_id')
        ->where('orders.id', '=', $id)
        ->get();
    }

    public function scopeGetDataDesignById($query, $id)
    {
        return $query->select([
          'orders.id',

          'order_item_cust_artworks.order_item_id as id_order_design',
          'order_item_cust_artworks.id as id_design',
          'order_item_cust_artworks.title',
           queryFormatPhotoWithAlias('order_item_cust_artworks.photo', 'designpath',[''=>'design','sm'=>'design_sm','xs'=>'design_xs']),

          'customers.fullname',
          \DB::raw('DATE_FORMAT(orders.created_at, "%d-%b-%Y")  as tgl_order')])
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('order_item_cust_artworks', 'order_items.id', '=', 'order_item_cust_artworks.order_item_id')
        ->leftjoin('customers', 'customers.id', '=', 'orders.customer_id')
        ->where('orders.id', '=', $id)->get();
    }

    public function getDataOrder($id)
    {
        return Order::select([
          'orders.id',
          'customers.fullname',
          'customers.email',
          'cities.name',
          'customers.mobile_phone',
           \DB::raw('DATE_FORMAT(orders.created_at, "%d-%b-%Y")  as tgl_order'),
          ])
          ->leftjoin('customers', 'customers.id', '=', 'orders.customer_id')
          ->leftjoin('cities', 'cities.id', '=', 'customers.cities_id')
          ->where('orders.id', $id)
          ->get()
        ;
    }

    public function getDataOrderItem($id)
    {

    }

    public function scopeGetDataOrderMasukVendor($query, $id)
    {
        $id_vendor = $id;
        $query = Order::select([
            'orders.id',
            'products.name',
            'products.id as product_id',
            \DB::raw('DATE_FORMAT(orders.created_at, "%d %b %Y")  as order_date'),
            'order_items.priority',
            'orders.total_item',
            'orders.flow_step',
            \DB::raw('(select
                product_images.id
                from product_images
                where product_images.product_id = products.id
                order by id asc
                limit 1
            ) as product_id'),
            queryFormatPhotoWithAlias('(select
                product_images.file_name
                from product_images
                where product_images.product_id = products.id
                order by id asc
                limit 1)', 'orderpaymentpath',[''=>'file_name','sm'=>'file_name_sm','xs'=>'file_name_xs']),
            ])
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->join('vendors_has_products', 'vendors_has_products.product_id', '=', 'products.id')
            ->leftjoin('order_item_materials', 'order_item_materials.id', '=', 'order_items.id')
            ->where('vendors_has_products.vendor_id', $id_vendor)
            ->whereIn('orders.flow_step', [2,3])
            ->whereNull('orders.deleted_at')
            ->get();
        return $query;
    }

    public function scopeGetDataOrderProsesVendor($id)
    {
        $id_vendor = $id;

        $query = Order::select([
            'orders.id',
            'products.name',
            'products.id as product_id',
            \DB::raw('DATE_FORMAT(orders.created_at, "%d %b %Y")  as order_date'),
            'order_items.priority',
            'orders.total_item',
            'orders.flow_step',
            queryFormatPhotoWithAlias('order_payments.proof_payment_dp', 'orderpaymentpath',[''=>'proof_payment_dp','sm'=>'proof_payment_dp_sm','xs'=>'proof_payment_dp_xs']),
            \DB::raw('(select
                product_images.id
                from product_images
                where product_images.product_id = products.id
                order by id asc
                limit 1
            ) as product_id'),
            queryFormatPhotoWithAlias('(select
                product_images.file_name
                from product_images
                where product_images.product_id = products.id
                order by id asc
                limit 1)', 'orderitemsteppath',[''=>'file_name','sm'=>'file_name_sm','xs'=>'file_name_xs']),
            ])
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->join('vendors_has_products', 'vendors_has_products.product_id', '=', 'products.id')
            ->leftjoin('order_item_materials', 'order_item_materials.id', '=', 'order_items.id')
            ->where('vendors_has_products.vendor_id', $id_vendor)
            ->whereIn('orders.flow_step', [4])
            ->whereNull('orders.deleted_at')
            ->get();
        return $query;
    }

    public function scopeGetDataOrderPelunasanVendor($id)
    {
        $id_vendor = $id;

        $query = Order::select([
            'orders.id',
            'products.name',
            'products.id as product_id',
            \DB::raw('DATE_FORMAT(orders.created_at, "%d %b %Y")  as order_date'),
            'orders.flow_step',
            'order_items.priority',
            queryFormatPhotoWithAlias('order_payments.proof_payment_pelunasan', 'orderpelunasanpath',[''=>'proof_payment_pelunasan','sm'=>'proof_payment_pelunasan_sm','xs'=>'proof_payment_pelunasan_xs']),
            'orders.total_item',
            \DB::raw('(select
                product_images.id
                from product_images
                where product_images.product_id = products.id
                order by id asc
                limit 1
            ) as product_id'),
            queryFormatPhotoWithAlias('(select
                product_images.file_name
                from product_images
                where product_images.product_id = products.id
                order by id asc
                limit 1)', 'orderpelunasanpath',[''=>'file_name','sm'=>'file_name_sm','xs'=>'file_name_xs']),
            ])
            ->join('order_payments', 'order_payments.order_id', '=', 'orders.id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->join('vendors_has_products', 'vendors_has_products.product_id', '=', 'products.id')
            ->leftjoin('order_item_materials', 'order_item_materials.id', '=', 'order_items.id')
            ->where('vendors_has_products.vendor_id', $id_vendor)
            ->whereIn('orders.flow_step', [7,8,9])
            ->whereNull('orders.deleted_at')
            ->get();
        return $query;
    }

    public function scopeGetDataOrderSelesaiProduksiVendor($id)
    {
        $id_vendor = $id;
        $query = Order::select([
            'orders.id',
            'products.name',
            'products.id as product_id',
            \DB::raw('DATE_FORMAT(orders.created_at, "%d %b %Y")  as order_date'),
            'order_items.priority',
            'orders.total_item',
            'order_items.id as id_order_item',
            'orders.flow_step',
            \DB::raw('(select
                product_images.id
                from product_images
                where product_images.product_id = products.id
                order by id asc
                limit 1
            ) as product_id'),
            queryFormatPhotoWithAlias('(select
                product_images.file_name
                from product_images
                where product_images.product_id = products.id
                order by id asc
                limit 1)', 'orderitemfinishpath',[''=>'file_name','sm'=>'file_name_sm','xs'=>'file_name_xs']),
            ])
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->join('vendors_has_products', 'vendors_has_products.product_id', '=', 'products.id')
            ->leftjoin('order_item_materials', 'order_item_materials.id', '=', 'order_items.id')
            ->where('vendors_has_products.vendor_id', $id_vendor)
            ->whereIn('orders.flow_step', [5])
            ->whereNull('orders.deleted_at')
            ->get();
        return $query;
    }


    public function getDataVendorSelesai($id)
    {
        return Order::select([
          'orders.id',
          'products.name',
          'orders.flow_step',
          'order_items.priority',
          'orders.total_item',
          \DB::raw('DATE_FORMAT(orders.created_at, "%d %b %Y")  as tgl_order'),
          \DB::raw('DATE_FORMAT(orders.updated_at, "%d %b %Y")  as tgl_order_selesai'),
          ])
        ->join('order_items', 'order_items.order_id', '=', 'orders.id')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->join('vendors_has_products', 'vendors_has_products.product_id', '=', 'products.id')
        ->where('vendors_has_products.vendor_id', $id)
        ->whereIn('orders.flow_step', [10,11])
        ->orderBy('orders.updated_at', 'DESC')
        ->get();
    }

    public function getImagePembayaran($id)
    {
        return Order::select([
            queryFormatPhotoWithAlias('order_payments.proof_payment_dp', 'vendordppath',[''=>'proof_payment_dp','sm'=>'proof_payment_dp_sm','xs'=>'proof_payment_dp_xs']),
            \DB::raw('DATE_FORMAT(order_payments.updated_at, "%d-%b-%Y")  as tgl_pembayaran'),
            \DB::raw('DATE_FORMAT(order_payments.updated_at, "%H:%i")  as waktu_pembayaran'),
          ])
        ->join('order_payments', 'order_payments.order_id', '=', 'orders.id')
        ->where('orders.id', $id)
        ->first();
    }

    public function getImagePelunasan($id)
    {
        return Order::select([
            queryFormatPhotoWithAlias('order_payments.proof_payment_pelunasan', 'vendorpelunasanpath',[''=>'proof_payment_pelunasan','sm'=>'proof_payment_pelunasan_sm','xs'=>'proof_payment_pelunasan_xs']),
            \DB::raw('DATE_FORMAT(order_payments.updated_at, "%d-%b-%Y")  as tgl_pembayaran'),
            \DB::raw('DATE_FORMAT(order_payments.updated_at, "%H:%i")  as waktu_pembayaran'),
          ])
        ->join('order_payments', 'order_payments.order_id', '=', 'orders.id')
        ->where('orders.id', $id)
        ->first();
    }


    public function getImageVendorDP($id)
    {
        return Order::select([
            queryFormatPhotoWithAlias('order_payments.proof_payment_dp', 'vendordppath',[''=>'proof_payment_dp','sm'=>'proof_payment_dp_sm','xs'=>'proof_payment_dp_xs']),
            \DB::raw('DATE_FORMAT(order_payments.updated_at, "%d-%b-%Y")  as tgl_pembayaran'),
            \DB::raw('DATE_FORMAT(order_payments.updated_at, "%H:%i")  as waktu_pembayaran'),
          ])
        ->join('order_payments', 'order_payments.order_id', '=', 'orders.id')
        ->where('orders.id', $id)
        ->first();
    }


    public function getImageProduct($id)
    {
        $image =  Order::select([
            'product_images.file_name',
        ])
        ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
        ->leftjoin('products', 'products.id', '=', 'order_items.product_id')
        ->leftjoin('product_images', 'product_images.product_id', '=', 'products.id')
        ->where('orders.id', $id)
        ->get();

        return $image;
    }


    public function getDataLog($id)
    {
        return Order::select([
            'orders.id',
            'role_id',
            'reason'
        ])
        ->leftJoin('artwork_design_log', 'artwork_design_log.order_id', '=', 'orders.id')
        ->where('artwork_design_log.order_id', $id)
        ->orderBy('artwork_design_log.created_at', 'ASC')
        ->get();
    }


    public function getSingleData($id)
    {
        return Order::with('hasCustomer')
            ->where('id', $id)
            ->whereNull('deleted_at')
            ->first();
    }


    public function getDataOrderById($id)
    {
        return Order::where('id', $id)
               ->whereNull('deleted_at')
               ->first();
    }

    public function scopeGetDataCustomerConfirmation($query)
    {
        return $query->select([
            'orders.id',
            'customers.fullname',
            'products.name',
            'order_items.priority',
             \DB::raw('DATE_FORMAT(orders.created_at, "%d-%b-%Y")  as tgl_order'),
            'orders.flow_step'
        ])
        ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
        ->leftJoin('customers', 'customers.id', '=', 'orders.customer_id')
        ->leftJoin('products', 'products.id', '=', 'order_items.product_id')
        ->where('flow_step', 0)
        ->whereNotNull('is_fulfilled')
        ->orderBy('orders.created_at');
    }

    public function scopeGetDataStep($query)
    {
        return $query->select([
              'orders.id',
              'orders.customer_id',
              'orders.payment_method',
              'orders.payment_type',
              'orders.part_paid_amount',
              'products.name',
              \DB::raw('DATE_FORMAT(orders.created_at, "%d-%b-%Y")  as tgl_order'),
              'order_items.priority',
              'order_item_steps.status',
              'customers.fullname'
            ])
        ->leftJoin('customers', 'customers.id', '=', 'orders.customer_id')
        ->leftJoin('order_items', 'orders.id', '=', 'order_items.order_id')
        ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
        ->leftJoin('order_item_steps', 'order_items.id', '=', 'order_item_steps.order_item_id')
        ->where('orders.flow_step', 4)
        ->groupBy('order_item_steps.order_item_id')
        ;

    }

    public function getDataOrderProgress($id)
    {
        return Order::select([
            'orders.id',
            'flow_step',
            'flow_step_date',
        ])
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('order_item_steps', 'order_items.id', '=', 'order_item_steps.order_item_id')
        ->where('order_item_steps.order_item_id', $id)
        ->first();
    }

    public function getDataOrderSelesai()
    {
        return Order::select([
            'orders.id',
            'customers.fullname',
            'products.name',
            'order_items.priority',
            'orders.total_item',
            \DB::raw('DATE_FORMAT(orders.created_at, "%d-%b-%Y")  as tgl_order'),

        ])
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->join('customers', 'customers.id', '=', 'orders.customer_id')
        ->leftJoin('complain_so', 'orders.id', '=', 'complain_so.order_id')
        ->whereNull('complain_so.order_id')
        ->whereNull('orders.deleted_at')
        ->where('orders.flow_step', 9)
        ->orderBy('orders.created_at', 'DESC')
        ->get();
    }

    public function getDataOrderSelesaiProduksi()
    {
        return Order::select([
          'orders.id',
          'customers.fullname',
          'products.name',
          'order_items.priority',
          'orders.total_item',
          'order_items.id as order_item_id',
          \DB::raw('DATE_FORMAT(orders.created_at, "%d-%b-%Y")  as tgl_order'),
          'complain_vendors.order_id',

          ])
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->join('customers', 'customers.id', '=', 'orders.customer_id')
        ->leftJoin('complain_vendors', 'orders.id', '=', 'complain_vendors.order_id')
        ->whereNull('complain_vendors.order_id')
        ->whereNull('orders.deleted_at')
        ->where('orders.flow_step', 5)
        ->orderBy('orders.created_at', 'DESC')
        ->get();
    }

    public function getDataComplainQCV()
    {
        $query = Order::with(['orderItems.hasProduct', 'orderLogMaster', 'complainVendor' => function ($query) {
              $query->orderBy('created_at', 'DESC');
        }, 'customer'])
        ->has('complainVendor')
        ->whereNull('orders.deleted_at')
        ->where('orders.flow_step', 5)
        ->get();

        return $query;
    }

    public function getDataComplainSOC()
    {
        $query = Order::with(['orderItems.hasProduct', 'orderLogMaster', 'complainSO' => function ($query) {
              $query->orderBy('created_at', 'DESC');
        }, 'customer'])
        ->has('complainSO')
        ->whereNull('orders.deleted_at')
        ->where('orders.flow_step', 9)
        ->get();

        return $query;
    }

    public function getSingleComplainSOC($id)
    {
        $query = Order::with(['orderItems.hasProduct', 'orderLogMaster', 'complainSO' => function ($query) use ($id) {
              $query->orderBy('created_at', 'DESC')->where('order_id', $id);
        }, 'customer'])
        ->has('complainSO')
        ->whereNull('orders.deleted_at')
        ->where('orders.flow_step', 9)
        ->get();

        return $query;
    }

    public function getSingleComplainQCV($id)
    {
        $query = Order::with(['orderItems.hasProduct', 'orderLogMaster', 'complainVendor' => function ($query) use ($id) {
              $query->orderBy('created_at', 'DESC')->where('order_id', $id);
        }, 'customer'])
        ->has('complainVendor')
        ->whereNull('orders.deleted_at')
        ->where('orders.flow_step', 5)
        ->get();

        return $query;
    }

    public function getAllRecord()
    {
        return Order::select([
        'orders.id',
        'orders.flow_step',
        \DB::raw('DATE_FORMAT(orders.flow_step_date, "%d %b %Y") as tgl_flow_step'),
        'customers.fullname',
        'products.name',
        'order_items.priority',
        'orders.total_item',
        \DB::raw('DATE_FORMAT(orders.created_at, "%d %b %Y")  as tgl_order'),

        ])
      ->join('order_items', 'orders.id', '=', 'order_items.order_id')
      ->join('products', 'products.id', '=', 'order_items.product_id')
      ->join('customers', 'customers.id', '=', 'orders.customer_id')
      ->whereNull('orders.deleted_at')
      ->orderBy('orders.created_at', 'DESC')
      ->get();
    }

    public function getDataOrderArrived()
    {
        return Order::select([
          'orders.id',
          'customers.fullname',
          'products.name',
          'order_items.priority',
          'orders.total_item',
          \DB::raw('DATE_FORMAT(orders.created_at, "%d-%b-%Y")  as tgl_order'),

          ])
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->join('customers', 'customers.id', '=', 'orders.customer_id')
        ->whereNull('orders.deleted_at')
        ->where('orders.flow_step', 10)
        ->orderBy('orders.created_at', 'DESC')
        ->get();
    }

    public function getComplainVendor($id)
    {
        $id_vendor = $id;
        $query = Order::with(['orderItems.hasProduct.hasImage', 'orderItems.hasProduct.hasVendor' => function ($query) use ($id_vendor) {
            return $query->where('vendor_id', '=', $id_vendor);
        }, 'orderItems.hasMaterial', 'orderLogMaster', 'complainVendor'])
        ->has('complainVendor')
        ->whereNull('orders.deleted_at')
        ->groupBy('orders.id')
        ->get();

        return $query;
    }


    public function getDataOrderMaterial($id)
    {
        $query = Order::with('orderItems.hasMaterial', 'orderItems.hasProduct')
        ->whereNull('orders.deleted_at')
        ->where('orders.id', $id)
        ->get();

        return $query;
    }

    public function getAdjustPrice($id)
    {
        $query = Order::with('orderItems.hasAdjustPrice')
        ->whereNull('orders.deleted_at')
        ->where('orders.id', $id)
        ->get();

        return $query;
    }

    public function getItemSize($id)
    {
        $q = Order::with('orderItems.hasItemSizes')->whereNull('orders.deleted_at')->where('orders.id', $id)->get();
        $i = 0;

        foreach ($q as $value) {
            $size_id = $value->orderItems[0]->hasItemSizes[$i]->size_id;
            $size_type = $value->orderItems[0]->hasItemSizes[$i]->size_type_id;
            $i++;
        }

        $query = Order::with([
            'orderItems.hasProduct.hasSubCategories.hasCategories.hasSize' => function ($query) use ($size_id) {
                $query->where('id', '=', $size_id);
            },
            'orderItems.hasItemSizes',
            'orderItems.hasProduct.hasSubCategories.hasCategories.hasSizeType' => function ($query) use ($size_type) {
                $query->where('id', '=', $size_type);
            }
        ])
        ->whereNull('orders.deleted_at')
        ->where('orders.id', $id)
        ->get();

        return $query;
    }

    public function getInfoDetail($id)
    {
        $q = Order::with('orderItems')->whereNull('orders.deleted_at')->where('orders.id', $id)->get();
        $i = 0;

        foreach ($q as$value) {
          $sizepack_id = $value->orderItems[0]->sizepack_id;
          $i++;
        }

        $query = Order::with(['orderItems.hasProduct.hasVendor.hasVendor.hasSizepack' => function ($qry) use ($sizepack_id){
          $qry->where('id', $sizepack_id);
        }, 'orderItems.hasProduct.hasAddOn.hasAddOn'
        ])
        ->whereNull('orders.deleted_at')
        ->where('orders.id', $id)
        ->get();

        return $query;
    }

    public function getDesign($id)
    {
        $query = Order::with(['orderItems.hasCustArtwork'
        ])
        ->whereNull('orders.deleted_at')
        ->where('orders.id', $id)
        ->get();

        return $query;
    }

    public function getArtwork($id)
    {
        $query = DB::table('orders')
        ->select('artwork_print_types.name as name_material','artwork_size.size as ukuran', 'artworks.name as posisi', 'order_item_artworks.color_qty', 'order_item_artworks.preview_image', 'order_item_artworks.zip_file', 'order_item_artworks.amount')
        ->join('order_items', 'order_items.order_id', '=', 'orders.id')
        ->join('order_item_artworks', 'order_item_artworks.order_item_id', '=', 'order_items.id')
        ->join('artwork_size', 'artwork_size.id', '=','order_item_artworks.artwork_size_id')
        ->join('artworks', 'artworks.id', '=', 'order_item_artworks.artwork_position')
        ->join('artwork_print_types', 'artwork_print_types.id', '=', 'order_item_artworks.artwork_print_type_id')
        ->join('artwork_print_methods', 'artwork_print_methods.id', '=', 'order_item_artworks.artwork_method_id')
        ->whereNull('orders.deleted_at')
        ->where('orders.id', $id)
        ->get();

        return $query;
    }

    public function getDesignReference($id)
    {
        $query = DB::table('orders')->select('order_item_design_reference.title', 'order_item_design_reference.preview_image')
        ->join('order_items', 'order_items.order_id', '=', 'orders.id')
        ->join('order_item_design_reference', 'order_item_design_reference.order_item_id', '=', 'order_items.id')
        ->whereNull('orders.deleted_at')
        ->where('orders.id', $id)
        ->get();

        return $query;
    }


    public function cetakResi($id)
    {
        $query = Order::with('customer', 'orderShipments')
            ->whereNull('orders.deleted_at')
            ->where('orders.id', $id)
            ->first();

        return $query;
    }

    public function scopeGetUploadImageVendor($query)
    {
        return $query->select([
              'orders.id',
              'orders.customer_id',
              'orders.payment_method',
              'orders.payment_type',
              'orders.total_item',
              'orders.part_paid_amount',
              \DB::raw('DATE_FORMAT(orders.created_at, "%d %b %Y") as tgl_order'),
              'order_payments.proof_payment',
              'order_payments.id as id_order_payment',
              'order_payments.order_id',
              'order_payments.type',
              'order_payments.status',
              'order_payments.is_dp',
              'order_payments.payment_total',
              'order_items.priority',
              'order_payments.proof_payment_dp as dp_name',
              queryFormatPhotoWithAlias('order_payments.proof_payment_dp', 'vendordppath',[''=>'proof_payment_dp','sm'=>'proof_payment_dp_sm','xs'=>'proof_payment_dp_xs']),
              queryFormatPhotoWithAlias('order_payments.proof_payment_pelunasan', 'vendorpelunasanpath',[''=>'proof_payment_pelunasan','sm'=>'proof_payment_pelunasan_sm','xs'=>'proof_payment_pelunasan_xs']),

              'products.name',
              \DB::raw('DATE_FORMAT(order_payments.created_at, "%d-%b-%Y")  as tgl_payment'),
              \DB::raw('DATE_FORMAT(order_payments.created_at, "%h:%i")  as log_created_time'),

              'customers.fullname'
            ])
        ->join('order_items', 'order_items.order_id', '=', 'orders.id')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->join('order_payments', 'order_payments.order_id', '=', 'orders.id')
        ->join('customers', 'customers.id', '=', 'orders.customer_id')
        ->whereIn('orders.flow_step', [3,4])
        ;
    }

    public function scopeGetUploadImageVendorPelunasan($query)
    {
        return $query->select([
              'orders.id',
              'orders.customer_id',
              'orders.payment_method',
              'orders.payment_type',
              'orders.total_item',
              'orders.part_paid_amount',
              \DB::raw('DATE_FORMAT(orders.created_at, "%d %b %Y") as tgl_order'),
              'order_payments.proof_payment',
              'order_payments.id as id_order_payment',
              'order_payments.order_id',
              'order_payments.type',
              'order_payments.status',
              'order_payments.is_dp',
              'order_payments.payment_total',
              'order_items.priority',
              'order_payments.proof_payment_pelunasan as pelunasan_name',
               queryFormatPhotoWithAlias('order_payments.proof_payment_dp', 'vendordppath',[''=>'proof_payment_dp','sm'=>'proof_payment_dp_sm','xs'=>'proof_payment_dp_xs']),
              queryFormatPhotoWithAlias('order_payments.proof_payment_pelunasan', 'vendorpelunasanpath',[''=>'proof_payment_pelunasan','sm'=>'proof_payment_pelunasan_sm','xs'=>'proof_payment_pelunasan_xs']),

              'products.name',
              \DB::raw('DATE_FORMAT(order_payments.created_at, "%d-%b-%Y")  as tgl_payment'),
              \DB::raw('DATE_FORMAT(order_payments.created_at, "%h:%i")  as log_created_time'),

              'customers.fullname'
            ])
        ->join('order_items', 'order_items.order_id', '=', 'orders.id')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->join('order_payments', 'order_payments.order_id', '=', 'orders.id')
        ->join('customers', 'customers.id', '=', 'orders.customer_id')
        ->whereIn('orders.flow_step', [7,8,9])
        ;
    }

    public function orderPayConfirmation()
    {
        return $this->hasMany(orderPayConfirmation::class);
    }

    public function orderPayment()
    {
        return $this->hasMany(OrderPayment::class, 'order_id', 'id');
    }

    public function orderPayPelunasan()
    {
        return $this->hasMany(orderPayPelunasan::class);
    }

    public function orderItems()
    {
      return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function orderLogMaster()
    {
      return $this->hasMany(OrderLogMaster::class, 'flow_step_id', 'flow_step');
    }

    public function complainVendor()
    {
      return $this->hasMany(ComplainVendor::class, 'order_id', 'id');
    }

    public function complainSO()
    {
      return $this->hasMany(ComplainSO::class, 'order_id', 'id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function hasSize()
    {
        return $this->hasMany('\App\Http\Models\Customer', 'id', 'customer_id');
    }

    public function orderShipments()
    {
      return $this->hasMany(OrderShipment::class, 'order_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
    }
}

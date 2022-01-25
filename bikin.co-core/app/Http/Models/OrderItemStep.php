<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OrderItemStep extends Model
{
     use SoftDeletes;

    public $timestamps = true;
    protected $soft_delete = true;

    protected $guarded =
    [

    ];

    public function getDataStep($id, $id_order)
    {
    	return OrderItemStep::select([
    		'order_item_steps.id',
    		'order_item_steps.order_item_id',
    		'step_title', 
    		'step_description', 
    		'role', 
    		'order_item_steps.status', 
    		'vendor_name', 
    		'order_item_steps.created_at', 
    		\DB::raw('DATE_FORMAT(order_item_steps.updated_at, "%d %b %Y") as tgl_update'),
    		])
    	->leftjoin('order_items', 'order_items.id', '=', 'order_item_steps.order_item_id')
    	->leftjoin('orders', 'orders.id', '=', 'order_items.order_id')
    	->leftjoin('products', 'products.id', '=', 'order_items.product_id')
    	->leftjoin('vendors_has_products', 'vendors_has_products.product_id', '=', 'products.id')
    	->leftjoin('vendors', 'vendors.id', '=', 'vendors_has_products.vendor_id')
    	->where('order_item_steps.status', $id)
    	->where('order_items.order_id', $id_order)
    	->get();
    }

    public function getSingleData($id)
    {
    	return OrderItemStep::where('id', $id)->whereNull('deleted_at')->first();
    }

    public function getDataById($id)
    {
    	return OrderItemStep::select([
    		'order_item_steps.id',
    		'order_item_steps.order_item_id',
    		'step_title', 
    		'step_description', 
    		'role', 
    		'order_item_steps.status', 
    		'vendor_name', 
    		'order_item_steps.created_at', 
    		\DB::raw('DATE_FORMAT(order_item_steps.updated_at, "%d %b %Y") as tgl_update'),
    		])
    	->leftjoin('order_items', 'order_items.id', '=', 'order_item_steps.order_item_id')
    	->leftjoin('orders', 'orders.id', '=', 'order_items.order_id')
    	->leftjoin('products', 'products.id', '=', 'order_items.product_id')
    	->leftjoin('vendors_has_products', 'vendors_has_products.product_id', '=', 'products.id')
    	->leftjoin('vendors', 'vendors.id', '=', 'vendors_has_products.vendor_id')
    	->where('order_items.order_id', $id)
    	->get();
    }




}

<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Http\Models\Order;

use Illuminate\Support\Facades\DB;



class ProductionStepMaster extends Model
{
    
    use SoftDeletes;

    public $timestamps = true;
    protected $soft_delete = true;

    protected $guarded =
    [

    ];

    public function getDataById($id)
    {
    	return ProductionStepMaster::where('category_id', $id)->first();
    }

    public function getSingleData($id)
    {
    	return ProductionStepMaster::where('id', $id)->first();
    }

    public function getDataByProduct($id)
    {
        return DB::table('orders')->select('production_step_masters.step_title', 'production_step_masters.step_description', 'order_items.id')
        ->join('order_items', 'order_items.order_id', '=', 'orders.id')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_categories_id')
        ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
        ->join('production_step_masters', 'production_step_masters.category_id', '=', 'categories.id')
        ->where('orders.id', $id)
        ->get();
    }
}

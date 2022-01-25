<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItemSpecification extends Model
{
    use SoftDeletes;

    public $table = "order_item_accessories";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'order_item_id',
        'product_specification_id', 
        'qty',
        'amount'
    ];

    public function getAllData()
    {
        return OrderItemSpecification::with('hasOrderItem')
                    ->with('hasProductSpecItem')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getAllDataByOrderItem($id)
    {
        return OrderItemSpecification::with('hasOrderItem')
                    ->with('hasProductSpecItem')
                    ->where('order_item_id', $id)
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return OrderItemSpecification::with('hasOrderItem')
                    ->with('hasProductSpecItem')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    public function getSingleDataByOrderItem($id)
    {
        return OrderItemSpecification::with('hasOrderItem')
                    ->with('hasProductSpecItem')
                    ->where('order_item_id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    /**
     * [hasOrderItem description]
     * @return [type] [description]
     */
    public function hasOrderItem()
    {
        return $this->hasOne('\App\Http\Models\OrderItem', 'id', 'order_item_id');
    }

    /**
     * [hasProductSpecItem description]
     * @return [type] [description]
     */
    public function hasProductSpecItem()
    {
        return $this->hasOne('\App\Http\Models\ProductSpecificationItem', 'id', 'product_specification_id');
    }
    
    /**
     * [boot description]
     * @return [type] [description]
     */
    public static function boot()
    {
        parent::boot();
    }
}
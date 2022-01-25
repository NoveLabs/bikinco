<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItemAdjustPrice extends Model
{
    use SoftDeletes;

    public $table = "order_item_adjust_price";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'order_item_id',
        'adjust_amount', 
        'note',
    ];

    public function getAllData()
    {
        return OrderItemAdjustPrice::with('hasOrderItem')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getAllDataByOrderItem($id)
    {
        return OrderItemAdjustPrice::with('hasOrderItem')
                    ->where('order_item_id', $id)
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return OrderItemAdjustPrice::with('hasOrderItem')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    public function getSingleDataByOrderItem($id)
    {
        return OrderItemAdjustPrice::with('hasOrderItem')
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
     * [boot description]
     * @return [type] [description]
     */
    public static function boot()
    {
        parent::boot();
    }
}
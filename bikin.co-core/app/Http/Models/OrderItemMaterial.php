<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItemMaterial extends Model
{
    use SoftDeletes;

    public $table = "order_item_materials";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'order_item_id',
        'material_color_id',
        'material_stock_id',
        'material_specification_id',
        'qty',
        'amount'
    ];

    public function getAllData()
    {
        return OrderItemMaterial::with('hasOrderItem')
                    ->with('hasMaterialSpecItem')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getAllDataByOrderItem($id)
    {
        return OrderItemMaterial::with('hasOrderItem')
                    ->with('hasMaterialSpecItem')
                    ->where('order_item_id', $id)
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return OrderItemMaterial::with('hasOrderItem')
                    ->with('hasMaterialSpecItem')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    public function getSingleDataByOrderItem($id)
    {
        return OrderItemMaterial::with('hasOrderItem')
                    ->with('hasMaterialSpecItem')
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
     * [hasMaterialSpecItem description]
     * @return [type] [description]
     */
    public function hasMaterialSpecItem()
    {
        return $this->hasOne('\App\Http\Models\MaterialSpecificationItem', 'id', 'material_specification_id');
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

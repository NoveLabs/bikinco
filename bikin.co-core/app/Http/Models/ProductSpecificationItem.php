<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSpecificationItem extends Model
{
    use SoftDeletes;

    public $table = "product_specification_items";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'name', 
        'product_specification_id',
        'status',
        'price',
    ];

    public function getAllData()
    {
        return ProductSpecificationItem::with('hasSpecification')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return ProductSpecificationItem::with('hasSpecification')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    public function getTotalDataBySpecification($id)
    {
        return ProductSpecificationItem::where('product_specification_id', $id)
                    ->whereNull('deleted_at')
                    ->count();
    }

    /**
     * [hasSpecification description]
     * @return [type] [description]
     */
    public function hasSpecification()
    {
        return $this->hasOne('\App\Http\Models\ProductSpecification', 'id', 'product_specification_id');
    }

    /**
     * [hasProduct description]
     * @return [type] [description]
     */
    public function hasProduct()
    {
        return $this->hasMany('\App\Http\Models\ProductHasSpecificationItem', 'product_specification_id', 'id');
    }

    /**
     * [hasOrderItemSpec description]
     * @return [type] [description]
     */
    public function hasOrderItemSpec()
    {
        return $this->hasMany('\App\Http\Models\OrderItemSpecification', 'product_specification_id', 'id');
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
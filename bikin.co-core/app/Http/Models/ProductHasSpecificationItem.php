<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductHasSpecificationItem extends Model
{
    use SoftDeletes;

    public $table = "product_has_specification_items";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'product_id', 
        'product_specification_id',
    ];

    public function getTotalDataBySpecification($id)
    {
        return ProductHasSpecificationItem::where('product_specification_id', $id)
                    ->whereNull('deleted_at')
                    ->count();
    }

    /**
     * [hasProduct description]
     * @return [type] [description]
     */
    public function hasProduct()
    {
        return $this->hasOne('\App\Http\Models\Product', 'id', 'product_id');
    }

    /**
     * [hasSpecificationItem description]
     * @return [type] [description]
     */
    public function hasSpecificationItem()
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
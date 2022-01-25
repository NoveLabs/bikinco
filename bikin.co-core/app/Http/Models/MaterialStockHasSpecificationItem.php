<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialStockHasSpecificationItem extends Model
{
    use SoftDeletes;

    public $table = "material_stocks_has_specification_items";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'material_stock_id', 
        'specification_item_id', 
    ];

    public function getTotalDataBySpecificiationItem($id)
    {
        return MaterialStockHasSpecificationItem::where('specification_item_id', $id)
                    ->whereNull('deleted_at')
                    ->count();
    }

    public function getTotalDataByMaterialStock($id)
    {
        return MaterialStockHasSpecificationItem::where('material_stock_id', $id)
                    ->whereNull('deleted_at')
                    ->count();
    }

    /**
     * [hasMaterialStock description]
     * @return [type] [description]
     */
    public function hasMaterialStock()
    {
        return $this->hasOne('\App\Http\Models\ProductMaterialStock', 'id', 'material_stock_id');
    }

    /**
     * [hasSpecificationItem description]
     * @return [type] [description]
     */
    public function hasSpecificationItem()
    {
        return $this->hasOne('\App\Http\Models\MaterialSpecificationItem', 'id', 'specification_item_id');
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
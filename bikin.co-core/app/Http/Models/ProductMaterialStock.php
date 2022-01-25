<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductMaterialStock extends Model
{
    use SoftDeletes;

    public $table = "product_material_stocks";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'supplier_id',
        'material_item_id', 
        'initial_stock', 
        'hold_on_stock', 
        'unit_id', 
        'note', 
    ];

    public function getAllData()
    {
        return ProductMaterialStock::with('hasMaterialItem')
                    ->with('hasSupplier')
                    ->with('hasUnit')
                    ->with('hasSpecificationItems.hasSpecificationItem')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return ProductMaterialStock::with('hasMaterialItem')
                    ->with('hasSupplier')
                    ->with('hasUnit')
                    ->with('hasSpecificationItems.hasSpecificationItem')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    public function getTotalDataBySupplier($id)
    {
        return ProductMaterialStock::where('supplier_id', $id)
                    ->whereNull('deleted_at')
                    ->count();
    }

    public function getTotalDataByMaterialItem($id)
    {
        return ProductMaterialStock::where('material_item_id', $id)
                    ->whereNull('deleted_at')
                    ->count();
    }

    public function getTotalDataByUnit($id)
    {
        return ProductMaterialStock::where('unit_id', $id)
                    ->whereNull('deleted_at')
                    ->count();
    }

    /**
     * [hasMaterialItem description]
     * @return [type] [description]
     */
    public function hasMaterialItem()
    {
        return $this->hasOne('\App\Http\Models\ProductMaterialItem', 'id', 'material_item_id');
    }

    /**
     * [hasSupplier description]
     * @return [type] [description]
     */
    public function hasSupplier()
    {
        return $this->hasOne('\App\Http\Models\Supplier', 'id', 'supplier_id');
    }

    /**
     * [hasUnit description]
     * @return [type] [description]
     */
    public function hasUnit()
    {
        return $this->hasOne('\App\Http\Models\Unit', 'id', 'unit_id');
    }

    /**
     * [hasSpecificationItems description]
     * @return [type] [description]
     */
    public function hasSpecificationItems()
    {
        return $this->hasMany('\App\Http\Models\MaterialStockHasSpecificationItem', 'material_stock_id', 'id');
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
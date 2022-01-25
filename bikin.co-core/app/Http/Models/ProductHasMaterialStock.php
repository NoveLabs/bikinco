<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductHasMaterialStock extends Model
{
    use SoftDeletes;

    public $table = "product_has_material_stocks";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'product_id', 
        'material_stock_id', 
        'qty', 
        'note', 
    ];

    public function getAllDataByProduct($productId)
    {
        return ProductHasMaterialStock::with('hasMaterialStock.hasMaterialItem.hasProductMaterial')
                    ->with('hasMaterialStock.hasSupplier')
                    ->with('hasMaterialStock.hasUnit')
                    ->with('hasProduct')
                    ->where('product_id', $productId)
                    ->whereNull('deleted_at')
                    ->get();

    }

    public function getSingleDataByProduct($id, $productId)
    {
        return ProductHasMaterialStock::with('hasMaterialStock.hasMaterialItem.hasProductMaterial')
                    ->with('hasMaterialStock.hasSupplier')
                    ->with('hasMaterialStock.hasUnit')
                    ->with('hasProduct')
                    ->where('id', $id)
                    ->where('product_id', $productId)
                    ->whereNull('deleted_at')
                    ->first();

    }

    public function getTotalDataByProduct($id)
    {
        return ProductHasMaterialStock::where('product_id', $id)
                    ->whereNull('deleted_at')
                    ->count();
    }

    public function getTotalDataByMaterialStock($id)
    {
        return ProductHasMaterialStock::where('material_stock_id', $id)
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
     * [hasProduct description]
     * @return [type] [description]
     */
    public function hasProduct()
    {
        return $this->hasOne('\App\Http\Models\Product', 'id', 'product_id');
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
<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductMaterialItem extends Model
{
    use SoftDeletes;

    public $table = "product_material_items";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'name', 
        'product_material_id',
        'status',
    ];

    public function getAllData()
    {
        return ProductMaterialItem::with('hasProductMaterial')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return ProductMaterialItem::with('hasProductMaterial')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    public function getTotalDataByMaterial($id)
    {
        return ProductMaterialItem::where('product_material_id', $id)
                    ->whereNull('deleted_at')
                    ->count();
    }

    /**
     * [hasProductMaterial description]
     * @return [type] [description]
     */
    public function hasProductMaterial()
    {
        return $this->hasOne('\App\Http\Models\ProductMaterial', 'id', 'product_material_id');
    }

    /**
     * [hasMaterialStock description]
     * @return [type] [description]
     */
    public function hasMaterialStock()
    {
        return $this->hasMany('\App\Http\Models\ProductMaterialStock', 'material_item_id', 'id');
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
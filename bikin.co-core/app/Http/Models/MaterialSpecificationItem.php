<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialSpecificationItem extends Model
{
    use SoftDeletes;

    public $table = "material_specification_items";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'material_specification_id',
        'material_item_id',
        'status',
    ];

    public function getAllData()
    {
        return MaterialSpecificationItem::with('hasProductMaterialItem')
            ->with('hasSpecification')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return MaterialSpecificationItem::with('hasSpecification')
            ->with('hasProductMaterialItem')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    public function getTotalDataBySpecificiation($id)
    {
        return MaterialSpecificationItem::where('material_specification_id', $id)
                    ->whereNull('deleted_at')
                    ->count();
    }

    /**
     * [hasSpecification description]
     * @return [type] [description]
     */
    public function hasSpecification()
    {
        return $this->hasOne('\App\Http\Models\MaterialSpecification', 'id', 'material_specification_id');
    }

    public function hasProductMaterialItem()
    {
        return $this->hasOne('\App\Http\Models\ProductMaterialItem', 'id', 'material_item_id');
    }

    /**
     * [hasMaterialStock description]
     * @return [type] [description]
     */
    public function hasMaterialStock()
    {
        return $this->hasMany('\App\Http\Models\MaterialStockHasSpecificationItem', 'specification_item_id', 'id');
    }

    /**
     * [hasOrderItemMaterial description]
     * @return [type] [description]
     */
    public function hasOrderItemMaterial()
    {
        return $this->hasMany('\App\Http\Models\OrderItemMaterial', 'id', 'material_specification_id');
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

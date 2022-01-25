<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductMaterial extends Model
{
    use SoftDeletes;

    public $table = "product_materials";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'name', 
        'status',
    ];

    public function getAllData()
    {
        return ProductMaterial::with('hasProductMaterialItems')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return ProductMaterial::with('hasProductMaterialItems')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    /**
     * [hasProductMaterialItems description]
     * @return [type] [description]
     */
    public function hasProductMaterialItems()
    {
        return $this->hasMany('\App\Http\Models\ProductMaterialItem', 'product_material_id', 'id');
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
<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAddon extends Model
{
    use SoftDeletes;

    public $table = "product_addons";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'name', 
        'is_has_material',
        'price',
        'status',
        'description',
    ];

    public function getAllData()
    {
        return ProductAddon::with('hasImage')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return ProductAddon::with('hasImage')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    /**
     * [hasImage description]
     * @return [type] [description]
     */
    public function hasImage()
    {
        return $this->hasMany('\App\Http\Models\ProductAddonImage', 'product_addon_id', 'id');
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
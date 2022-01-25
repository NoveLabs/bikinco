<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAddonImage extends Model
{
    use SoftDeletes;

    public $table = "product_addon_images";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'file_name', 
        'product_addon_id',
        'view_sort',
    ];

    public function getAllData()
    {
        return ProductAddonImage::with('hasAddon')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return ProductAddonImage::with('hasAddon')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    /**
     * [hasAddon description]
     * @return [type] [description]
     */
    public function hasAddon()
    {
        return $this->hasMany('\App\Http\Models\ProductAddon', 'id', 'product_addon_id');
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
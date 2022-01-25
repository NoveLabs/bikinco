<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public $table = "products";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'sub_categories_id', 'name', 'price', 'status', 'file_name','weight_approx'
    ];

    public function getAllData()
    {
        return Product::with('hasSubCategories.hasCategories')
                    ->with('hasImage')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return Product::with('hasSubCategories.hasCategories')
                    ->with('hasImage')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    public function getTotalData($status = 1, $searchName = '')
    {
        return Product::where('status', $status)
                    ->when(!empty($searchName), function($query) use ($searchName) {
                        return $query->where('name', 'like', "%{$searchName}%");
                    })
                    ->whereNull('deleted_at')->count();
    }

    public function getImageProduct($id)
    {
      return Product::select([
          'product_images.file_name',
        ])
        ->join('product_images', 'product_images.product_id', '=', 'products.id')
        ->where('products.id', $id)
        ->get();
    }

    /**
     * [hasSubCategories description]
     * @return [type] [description]
     */
    public function hasSubCategories()
    {
        return $this->hasOne('\App\Http\Models\SubCategory', 'id', 'sub_categories_id');
    }

    /**
     * [hasImage description]
     * @return [type] [description]
     */
    public function hasImage()
    {
        return $this->hasMany('\App\Http\Models\ProductImage', 'product_id', 'id');
    }

    /**
     * [hasSpecificationItem description]
     * @return [type] [description]
     */
    public function hasSpecificationItem()
    {
        return $this->hasMany('\App\Http\Models\ProductHasSpecificationItem', 'product_id', 'id');
    }

    /**
     * [hasVendor description]
     * @return [type] [description]
     */
    public function hasVendor()
    {
        return $this->hasMany('\App\Http\Models\VendorHasProduct', 'product_id', 'id');
    }

    /**
     * [hasOrderItem description]
     * @return [type] [description]
     */
    public function hasOrderItem()
    {
        return $this->hasMany('\App\Http\Models\OrderItem', 'product_id', 'id');
    }

    public function hasAddOn()
    {
        return $this->hasOne('\App\Http\Models\ProductHasAddOn', 'product_id', 'id');
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

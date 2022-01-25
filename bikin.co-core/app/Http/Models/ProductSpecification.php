<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSpecification extends Model
{
    use SoftDeletes;

    public $table = "product_specifications";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'status',
        'subcategory_id',
    ];

    public function getAllData()
    {
        return ProductSpecification::with('hasItem')
            ->with('hasSubcategory')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return ProductSpecification::with('hasItem')
            ->with('hasSubcategory')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    /**
     * [hasItem description]
     * @return [type] [description]
     */
    public function hasItem()
    {
        return $this->hasMany('\App\Http\Models\ProductSpecificationItem', 'product_specification_id', 'id');
    }

    public function hasSubcategory()
    {
        return $this->hasOne('\App\Http\Models\SubCategory', 'id', 'subcategory_id');
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

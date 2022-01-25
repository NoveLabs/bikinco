<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductHasAddon extends Model
{
    use SoftDeletes;

    public $table = "product_has_addons";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'product_id', 
        'product_addon_id',
    ];

    /**
     * [hasProduct description]
     * @return [type] [description]
     */
    public function hasProduct()
    {
        return $this->hasOne('\App\Http\Models\Product', 'id', 'product_id');
    }

    /**
     * [hasAddon description]
     * @return [type] [description]
     */
    public function hasAddon()
    {
        return $this->hasOne('\App\Http\Models\ProductAddon', 'id', 'product_addon_id');
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
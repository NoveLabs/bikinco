<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorHasProduct extends Model
{
    use SoftDeletes;

    public $table = "vendors_has_products";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'vendor_id', 'product_id'
    ];

    public function getAllData()
    {
        return VendorHasProduct::with('hasProduct')
                    ->with('hasVendor')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleDataByVendor($id)
    {
        return VendorHasProduct::with('hasProduct')
                    ->with('hasVendor')
                    ->where('vendor_id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    public function getSingleDataByProduct($id)
    {
        return VendorHasProduct::with('hasProduct')
                    ->with('hasVendor')
                    ->where('product_id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    /**
     * [hasVendor description]
     * @return [type] [description]
     */
    public function hasVendor()
    {
        return $this->hasOne('\App\Http\Models\Vendor', 'id', 'vendor_id');
    }

    /**
     * [hasProduct description]
     * @return [type] [description]
     */
    public function hasProduct()
    {
        return $this->hasOne('\App\Http\Models\Product', 'id', 'product_id')->withTrashed();
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
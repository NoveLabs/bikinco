<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;

    public $table = "order_items";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'order_id','product_id','sizepack_id','priority','cust_to_own_type','own_to_cust_type',
        'is_custom_label','label_photo','is_repackaging','packaging_note','packaging_photo',
        'is_washing','washing_id','is_has_design','design_photo','order_date','completed_date',
        'vendor_id',
        'vendor_mou_date',
        'vendor_mou_completed_date',
        'note',
        'product_price',
        'sum_product_price',
        'sum_size_price',
        'sum_accs_price',
        'sum_addon_price',
        'sum_adj_price',
        'sum_artworks_price',
        'sum_material_price',
    ];

    public function getAllData()
    {
        return OrderItem::with('hasDetailOrder')
                    ->with('hasProduct')
                    ->with('hasSizepack')
                    ->with('hasVendor')
                    ->with('hasMaterial')
                    ->with('hasSpecification')
                    ->with('hasAdjustPrice')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return OrderItem::with('hasDetailOrder')
                    ->with('hasProduct')
                    ->with('hasSizepack')
                    ->with('hasVendor')
                    ->with('hasMaterial')
                    ->with('hasSpecification')
                    ->with('hasAdjustPrice')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    public function getTotalDataByOrderId($id)
    {
        return OrderItem::where('order_id', $id)
                    ->whereNull('deleted_at')
                    ->count();
    }

    public function getTotalDataByProduct($id)
    {
        return OrderItem::where('product_id', $id)
                    ->whereNull('deleted_at')
                    ->count();
    }

    public function getTotalDataBySizepack($id)
    {
        return OrderItem::where('sizepack_id', $id)
                    ->whereNull('deleted_at')
                    ->count();
    }

    public function getTotalDataByVendor($id)
    {
        return OrderItem::where('vendor_id', $id)
                    ->whereNull('deleted_at')
                    ->count();
    }

    /**
     * [hasDetailOrder description]
     * @return [type] [description]
     */
    public function hasDetailOrder()
    {
        return $this->hasOne('\App\Http\Models\Order', 'id', 'order_id');
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
     * [hasSizepack description]
     * @return [type] [description]
     */
    public function hasSizepack()
    {
        return $this->hasOne('\App\Http\Models\Product', 'id', 'sizepack_id');
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
     * [hasMaterial description]
     * @return [type] [description]
     */
    public function hasMaterial()
    {
        return $this->hasMany('\App\Http\Models\OrderItemMaterial', 'order_item_id', 'id');
    }

    /**
     * [hasSpecification description]
     * @return [type] [description]
     */
    public function hasSpecification()
    {
        return $this->hasMany('\App\Http\Models\OrderItemSpecification', 'order_item_id', 'id');
    }

    public function hasItemSizes()
    {
        return $this->hasMany('\App\Http\Models\OrderItemSize', 'order_item_id', 'id');
    }

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * [hasAdjustPrice description]
     * @return [type] [description]
     */
    public function hasAdjustPrice()
    {
        return $this->hasMany('\App\Http\Models\OrderItemAdjustPrice', 'order_item_id', 'id');
    }

    public function hasCustArtwork()
    {
        return $this->hasMany('\App\Http\Models\OrderItemCustArtwork', 'order_item_id', 'id');
    }

    public function hasArtwork()
    {
        return $this->hasMany('\App\Http\Models\OrderItemArtwork', 'order_item_id', 'id');
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

<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    use SoftDeletes;

    public $table = "product_images";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'product_id', 'file_name'
    ];

    public function getAllData()
    {
        return ProductImage::with('hasProduct')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getAllDataByProduct($productId)
    {
        return ProductImage::with('hasProduct')
                    ->where('product_id', $productId)
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return ProductImage::with('hasProduct')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    public function scopeGetProductImage($query, $id)
    {
        return $query->select([
            'id',
            'product_id',
            queryFormatPhotoWithAlias('file_name', 'productpath',[''=>'file_name','sm'=>'file_name_sm','xs'=>'file_name_xs']),
            ])
            ->where('product_id', $id)
            ->whereNull('deleted_at')->get();
    }

    public function scopeGetSingleProductImage($query, $id)
    {
        return $query->select([
            'id',
            'product_id',
            'file_name'
            ])
            ->where('id', $id)
            ->whereNull('deleted_at');
    }

    public function getTotalData($status = 1, $productId = '')
    {
        return ProductImage::where('status', $status)
                    ->when(!empty($productId), function($query) use ($productId) {
                        return $query->where('product_id', $productId);
                    })
                    ->whereNull('deleted_at')->count();
    }

    /**
     * [hasProduct description]
     * @return [type] [description]
     */
    public function hasProduct()
    {
        return $this->hasOne('\App\Http\Models\Product', 'id', 'product_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
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
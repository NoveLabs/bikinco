<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItemFinishedImage extends Model
{
    use SoftDeletes;

    public $table = "order_item_finished_photos";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $guarded = [
      
    ];

    public function scopeGetAllDataImage($query, $id)
    {
        return $query->select([
            'id',
            'order_item_id',
            queryFormatPhotoWithAlias('image', 'orderitemfinishpath',[''=>'image','sm'=>'image_sm','xs'=>'image_xs']),
            'created_at',
            ])
            ->where('order_item_id', $id)
            ->get();
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

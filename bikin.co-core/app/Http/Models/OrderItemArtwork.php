<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItemArtwork extends Model
{

    public $table = "order_item_artworks";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'order_item_id',
        'artwork_size_id',
        'artwork_position',
        'color_qty',
        'amount',
        'preview_image',
        'zip_file',
        'product_addon_id',
        'artwork_print_type_id',
        'artwork_method_id',
    ];

    protected $guarded = [
    ];

    public function getSingleData($id)
    {
    	return OrderItemArtwork::all()->where('id', $id)->first();
    }

    public function orderItem()
    {
        return $this->hasOne('\App\Http\Models\OrderItem', 'id', 'order_item_id');
    }
}

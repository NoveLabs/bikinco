<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItemCustArtwork extends Model
{
    protected $fillable = [
        'order_item_id',
        'title',
        'photo'
    ];

    public function orderItem()
    {
        return $this->hasMany('\App\Http\Models\OrderItem', 'id', 'order_item_id');
    }
}

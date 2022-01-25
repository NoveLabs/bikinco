<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItemSize extends Model
{
    protected $table = 'order_item_sizes';
    public $timestamps = true;

    protected $fillable = [
        'order_item_id',
        'size_id',
        'size_type_id',
        'qty',
        'amount'
    ];

    public function hasOrderItem()
    {
        return $this->hasOne('\App\Http\Models\OrderItem', 'id', 'order_item_id');
    }
}

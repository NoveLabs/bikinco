<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItemAccessories extends Model
{
    use SoftDeletes;
    protected $table = 'order_item_accessories';
    public $timestamps = true;
    public $soft_delete = true;
    protected $fillable = [
        'order_item_id',
        'product_specification_item_id',
        'qty',
        'amount',
        'note',
        ''
    ];
}

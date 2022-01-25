<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItemDesign extends Model
{

    public $table = "order_item_design_reference";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $guarded = [

    ];
}

<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class OrderItemStepImage extends Model
{

    public $timestamps = true;

    protected $guarded =
    [

    ];

   public function scopeGetAllDataImage($query, $id)
   {	
   		return $query->select([
   			'id',
   			'order_item_step_id',
   			queryFormatPhotoWithAlias('photo', 'orderitemsteppath',[''=>'photo','sm'=>'photo_sm','xs'=>'photo_xs']),
   			'created_at',
   			])
   			->where('order_item_step_id', $id)
   			->get();
   }
}	
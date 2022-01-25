<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class OrderItemStepNote extends Model
{

    public $timestamps = true;

    protected $guarded =
    [

    ];

    public function getAllDataNote($id)
    {
    	return OrderItemStepNote::select([
    		'notes',
    		'username',
    		 \DB::raw('DATE_FORMAT(order_item_step_notes.created_at, "%d, %b %Y %H:%i")  as tanggal_note'),

    		])
    		->leftjoin('users', 'users.id', '=', 'order_item_step_notes.created_by')
    		->where('order_item_step_id', $id)
	    	->whereNull('order_item_step_notes.deleted_at')
            ->orderBy('order_item_step_notes.created_at', 'DESC')
	    	->get();
    }
}
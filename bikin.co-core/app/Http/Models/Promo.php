<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promo extends Model
{
    use softDeletes;

    public $table = "promo";
 	protected $soft_delete = true;
    public $timestamps = true;

    protected $guarded = [ ];

    public function scopeGetAllRecord($query)
    {
    	return $query->select([
    		'id',
    		'title',
            queryFormatPhotoWithAlias('image', 'promopath',[''=>'image','sm'=>'image_sm','xs'=>'image_xs']),
            'period_start',
            'period_end',
            'status',
    		])
    		->whereNull('deleted_at');
    }

    public function scopeGetSingleRecord($query, $id)
    {
    	return $query->select([
    		'id',
    		'title',
            queryFormatPhotoWithAlias('image', 'promopath',[''=>'image','sm'=>'image_sm','xs'=>'image_xs']),
            'period_start',
            'period_end',
            'coupon_code',
            'terms_condition',
            'min_transactions',
            'description',
            'status',
    		])
    		->where('id', $id)
    		->whereNull('deleted_at');
    }
}

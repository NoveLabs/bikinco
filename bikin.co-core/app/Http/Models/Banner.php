<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
	use softDeletes;

    public $table = "banner";
 	protected $soft_delete = true;
    public $timestamps = true;

    protected $guarded = [ ];

    public function scopeGetAllRecord($query)
    {
        return $query->select([
            'id',
            queryFormatPhotoWithAlias('images', 'bannerpath',[''=>'images','sm'=>'images_sm','xs'=>'images_xs']),
            'link',
            'status'
            ])
            ->whereNull('deleted_at');
    }

    public function scopeGetSingleRecord($query, $id)
    {
        return $query->select([
            'id',
            queryFormatPhotoWithAlias('images', 'bannerpath',[''=>'images','sm'=>'images_sm','xs'=>'images_xs']),
            'link',
            'status'
            ])
        ->where('id', $id)
        ->whereNull('deleted_at');
    }
    public function getAll()
    {
    	return Banner::whereNull('deleted_at');
    }

    public function getSingleData($id)
    {
    	return Banner::where('id', $id)->whereNull('deleted_at')->first();
    }
}

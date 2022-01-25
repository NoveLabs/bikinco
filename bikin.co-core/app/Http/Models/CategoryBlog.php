<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryBlog extends Model
{
    use softDeletes;

    public $table = "category_blog";
 	protected $soft_delete = true;
    public $timestamps = true;

    protected $guarded = [ ];

    public function scopeGetAllRecord($query)
    {
    	return $query->select([
    		'id',
    		'name',
    		])
    		->whereNull('deleted_at');
    }

    public function scopeGetSingleRecord($query, $id)
    {
    	return $query->select([
    		'id',
    		'name',
    		])
    		->where('id', $id)
    		->whereNull('deleted_at');
    }

    public function getAll()
    {
    	return CategoryBlog::whereNull('deleted_at');
    }

    public function getSingleData($id)
    {
    	return CategoryBlog::where('id', $id)->whereNull('deleted_at')->first();
    }
}

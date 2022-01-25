<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use softDeletes;

    public $table = "blog";
 	protected $soft_delete = true;
    public $timestamps = true;

    protected $guarded = [ ];

    public function scopeGetAllRecord($query)
    {
    	return $query->select([
    		'blog.id',
    		'title',
            queryFormatPhotoWithAlias('image', 'blogpath',[''=>'image','sm'=>'image_sm','xs'=>'image_xs']),
            'content',
            'status',
            'category_blog.id as id_cat',
            'category_blog.name'
    		])
            ->join('category_blog', 'category_blog.id', '=', 'blog.category_blog_id')
    		->whereNull('blog.deleted_at');
    }

    public function scopeGetSingleRecord($query, $id)
    {
    	return $query->select([
    		'blog.id',
    		'title',
            queryFormatPhotoWithAlias('image', 'blogpath',[''=>'image','sm'=>'image_sm','xs'=>'image_xs']),
            'content',
            'status',
            'category_blog.id as id_cat',
            'category_blog.name'
    		])
            ->join('category_blog', 'category_blog.id', '=', 'blog.category_blog_id')
    		->where('blog.id', $id)
    		->whereNull('blog.deleted_at');
    }

    public function getAll()
    {
    	return Blog::join('category_blog', 'category_blog.id', '=', 'blog.category_blog_id')->whereNull('blog.deleted_at');
    }

    public function getSingleData($id)
    {
    	return Blog::select([
            'blog.id', 
            'blog.title',
            'blog.content',
            queryFormatPhotoWithAlias('image', 'blogpath',[''=>'image','sm'=>'image_sm','xs'=>'image_xs']),
            'blog.status',
            'category_blog.id as id_cat',
            'category_blog.name',
            ])
            ->join('category_blog', 'category_blog.id', '=', 'blog.category_blog_id')
            ->where('blog.id', $id)
            ->whereNull('blog.deleted_at')
            ->first();
    }
}

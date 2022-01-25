<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public $table = "categories";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'name', 'status', 'file_name', 'category_icon', 'width_fname', 'height_fname', 'width_icon', 'height_icon'
    ];

    public function scopeGetAllRecord($query)
    {
        return $query->select([
            'categories.id',
            'categories.name',
            'categories.status',
            queryFormatPhotoWithAlias('categories.file_name','categorypath',[''=>'file_name','sm'=>'file_name_sm','xs'=>'file_name_xs']),
            queryFormatPhotoWithAlias('categories.category_icon','categoryiconpath',[''=>'category_icon','sm'=>'category_icon_sm','xs'=>'category_icon_xs']),
            'categories.status',
            // queryFormatDate('categories.created_at', 'fcreated_date_time', ' "%Y-%b-%d %H:%i" '),
            'categories.created_at',
            ])
        ->whereNull('deleted_at');

    }

    public function scopeGetSingleRecord($query, $id)
    {
        return $query->select([
            'categories.id',
            'categories.name',
            'categories.status',
            queryFormatPhotoWithAlias('categories.file_name','categorypath',[''=>'file_name','sm'=>'file_name_sm','xs'=>'file_name_xs']),
            queryFormatPhotoWithAlias('categories.category_icon','categoryiconpath',[''=>'category_icon','sm'=>'category_icon_sm','xs'=>'category_icon_xs']),
            ])
        ->where('categories.id', $id)
        ->whereNull('deleted_at');
        ;
    }


    public function getAllData()
    {
        return Category::with('subCategories')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return Category::with('subCategories')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    public function getTotalData($status = 1, $searchName = '')
    {
        return Category::where('status', $status)
                    ->when(!empty($searchName), function($query) use ($searchName) {
                        return $query->where('name', 'like', "%{$searchName}%");
                    })
                    ->whereNull('deleted_at')->count();
    }


    /**
     * [subCategories description]
     * @return [type] [description]
     */
    public function subCategories()
    {
        return $this->hasMany('\App\Http\Models\SubCategory', 'categories_id', 'id');
    }

    public function hasSize()
    {
        return $this->hasMany('\App\Http\Models\Size', 'categories_id', 'id');
    }

    public function hasSizeType()
    {
        return $this->hasMany('\App\Http\Models\SizeType', 'categories_id', 'id');
    }


    /**
     * [boot description]
     * @return [type] [description]
     */
    public static function boot()
    {
        parent::boot();
    }
}


<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;
    
    public $table = "sub_categories";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'name', 'categories_id', 'status', 'file_name'
    ];

    public function getAllData()
    {
        return SubCategory::with('hasCategories')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getAllDataByCategories($id)
    {
        return SubCategory::with('hasCategories')
                    ->where('categories_id', $id)
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return SubCategory::with('hasCategories')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    public function scopeGetSingleRecord($query, $id)
    {
        return $query->select([
            'sub_categories.id',
            'sub_categories.name',
            'sub_categories.status',
            'sub_categories.created_at',
            queryFormatPhotoWithAlias('sub_categories.file_name', 'subcategoriespath',[''=>'file_name','sm'=>'file_name_sm','xs'=>'file_name_xs']),
            'categories.name as name_category',
            'sub_categories.categories_id',
            ])
            ->leftjoin('categories', 'categories.id', '=', 'sub_categories.categories_id')
            ->where('sub_categories.id', $id)
            ->whereNull('sub_categories.deleted_at');
    }

    public function getTotalData($status = 1)
    {
        return SubCategory::where('status', $status)->whereNull('deleted_at')->count();
    }

    public function checkTotalCategoriesOnSub($id)
    {
        return SubCategory::where('categories_id', $id)
                    ->whereNull('deleted_at')
                    ->count();
    }

    /**
     * [hasCategories description]
     * @return [type] [description]
     */
    public function hasCategories()
    {
        return $this->hasOne('\App\Http\Models\Category', 'id', 'categories_id');
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
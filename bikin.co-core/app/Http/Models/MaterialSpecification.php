<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialSpecification extends Model
{
    use SoftDeletes;

    public $table = "material_specifications";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'name', 
        'status',
    ];

    public function getAllData()
    {
        return MaterialSpecification::with('hasSpecificationItems')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return MaterialSpecification::with('hasSpecificationItems')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    /**
     * [hasSpecificationItems description]
     * @return [type] [description]
     */
    public function hasSpecificationItems()
    {
        return $this->hasMany('\App\Http\Models\MaterialSpecificationItem', 'material_specification_id', 'id');
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
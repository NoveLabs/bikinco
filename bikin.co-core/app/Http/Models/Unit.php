<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;

    public $table = "units";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'name', 
        'status',
    ];

    public function getAllData()
    {
        return Unit::whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return Unit::where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    public function getSingleDataByName($name, $exceptId = 0)
    {
        return Unit::where('name', $name)
                    ->when($exceptId > 0, function ($sql) use ($exceptId) {
                        return $sql->where('id', '<>', $exceptId);
                    })
                    ->whereNull('deleted_at')
                    ->first();
    }

    /**
     * [hasMaterialStock description]
     * @return [type] [description]
     */
    public function hasMaterialStock()
    {
        return $this->hasMany('\App\Http\Models\ProductMaterialStock', 'unit_id', 'id');
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
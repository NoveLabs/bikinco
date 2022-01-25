<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    public $table = "suppliers";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'pic_name', 
        'pic_phone_number',
        'status',
        'company_name',
        'company_contact',
        'company_address'
    ];

    public function getAllData()
    {
        return Supplier::whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return Supplier::where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    public function getSingleDataByCustom($columnName, $columnValue, $exceptId = 0)
    {
        return Unit::where($columnName, $columnValue)
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
        return $this->hasMany('\App\Http\Models\ProductMaterialStock', 'supplier_id', 'id');
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
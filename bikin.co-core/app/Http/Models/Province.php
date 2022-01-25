<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use SoftDeletes;

    public $table = "provinces";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'name'
    ];

    public function getAllData()
    {
        return Province::with('hasCities')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return Province::with('hasCities')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    /**
     * [hasCities description]
     * @return [type] [description]
     */
    public function hasCities()
    {
        return $this->hasMany('\App\Http\Models\Cities', 'province_id', 'id');
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
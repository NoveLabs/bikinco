<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cities extends Model
{
    use SoftDeletes;

    public $table = "cities";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'province_id', 'name'
    ];

    public function getAllData()
    {
        return Cities::with('hasProvince')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getAllDataByProvince($id)
    {
        return Cities::with('hasProvince')
                    ->where('province_id', $id)
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return Cities::with('hasProvince')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    public function getTotalDataByProvince($id)
    {
        return Cities::where('province_id', $id)
                    ->whereNull('deleted_at')
                    ->count();
    }

    /**
     * [hasProvince description]
     * @return [type] [description]
     */
    public function hasProvince()
    {
        return $this->hasOne('\App\Http\Models\Province', 'id', 'province_id');
    }

    /**
     * [hasCustomer description]
     * @return [type] [description]
     */
    public function hasCustomer()
    {
        return $this->hasMany('\App\Http\Models\Customer', 'cities_id', 'id');
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
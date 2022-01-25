<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerWork extends Model
{
    use SoftDeletes;

    public $table = "customer_works";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'name'
    ];

    public function getAllData()
    {
        return CustomerWork::with('hasCustomer')
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return CustomerWork::with('hasCustomer')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    /**
     * [hasCustomer description]
     * @return [type] [description]
     */
    public function hasCustomer()
    {
        return $this->hasMany('\App\Http\Models\Customer', 'work_id', 'id');
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
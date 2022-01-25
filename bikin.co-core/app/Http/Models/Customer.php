<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Order;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    public $table = "customers";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'fullname','email','company_name','mobile_phone','work_id',
        'cities_id','is_verified','verified_date','latest_ordering','address',
        'identity_id','photo'
    ];

    public function getAllData()
    {
        return Customer::with('hasCities.hasProvince')
            ->with('hasWork')
            ->whereNull('deleted_at')
            ->get();
    }

    public function getSingleData($id)
    {
        return Customer::with('hasCities.hasProvince')
            ->with('hasWork')
            ->where('id', $id)
            ->whereNull('deleted_at')
            ->first();
    }

    public function getSingleDataToken($token)
    {
        return Customer::with('hasCities.hasProvince')
            ->with('hasWork')
            ->where('token', $token)
            ->whereNull('deleted_at')
            ->first();
    }

    public function getTotalDataByCities($id)
    {
        return Customer::where('cities_id', $id)
            >whereNull('deleted_at')
            ->count();
    }

    public function getTotalDataByWork($id)
    {
        return Customer::where('work_id', $id)
            ->whereNull('deleted_at')
            ->count();
    }

    public function getAllCustomerOrder()
    {
        return Customer::with('hasCities.hasProvince')
            ->with('hasWork')
            ->with('hasOrder')
            ->whereNull('deleted_at')
            ->get();
    }

    public function getCustomerOrderById($id)
    {
        return Customer::with('hasCities.hasProvince')
            ->with('hasWork')
            ->with('hasOrder')
            ->where('id', $id)
            ->whereNull('deleted_at')
            ->first();
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'customer_id', 'id');
    }


    public function hasCities()
    {
        return $this->hasOne('\App\Http\Models\Cities', 'id', 'cities_id');
    }


    public function hasWork()
    {
        return $this->hasOne('\App\Http\Models\CustomerWork', 'id', 'work_id');
    }


    public function hasOrder()
    {
        return $this->hasMany('\App\Http\Models\Order', 'customer_id', 'id');
    }
    
    public static function boot()
    {
        parent::boot();
    }
}
<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use SoftDeletes;

    public $table = "vendors";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = 
    [
        'vendor_name',
        'owner_name',
        'contact',
        'website',
        'username',
        'email',
        'cities_id',
        'address'
    ];

    public function getAllData()
    {
        return Vendor::with('hasProducts.hasProduct')
            ->with('hasCities.hasProvince')
            ->whereNull('deleted_at')
            ->get();
    }

    public function getSingleData($id)
    {
        return Vendor::with('hasProducts.hasProduct')
            ->with('hasCities.hasProvince')
            ->where('id', $id)
            ->whereNull('deleted_at')
            ->first();
    }

    public function getDataVendor($email)
    {
        return Vendor::where('email', $email)
        ->whereNull('deleted_at')
        ->first();
    }

    public function hasCities()
    {
        return $this->hasOne('\App\Http\Models\Cities', 'id', 'cities_id');
    }

    public function hasProducts()
    {
        return $this->hasMany('\App\Http\Models\VendorHasProduct', 'vendor_id', 'id');
    }

    public function hasOrderItems()
    {
        return $this->hasMany('\App\Http\Models\OrderItem', 'vendor_id', 'id');
    }

    public function hasSizePack()
    {
        return $this->hasMany('\App\Http\Models\Sizepack', 'vendor_name', 'id');
    }

    public function getAuthPassword()
    {
      return $this->password;
    }

    public static function boot()
    {
        parent::boot();
    }
}
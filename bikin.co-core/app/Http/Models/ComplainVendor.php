<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplainVendor extends Model
{
    use SoftDeletes;

    public $table = "complain_vendors";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $guarded = [

    ];

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
    
    public static function boot()
    {
        parent::boot();
    }
}

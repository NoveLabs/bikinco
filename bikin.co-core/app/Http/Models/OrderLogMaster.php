<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class OrderLogMaster extends Model
{

    public $table = "order_log_masters";
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
<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use App\Http\Models\Order;

use App\Http\Models\Customer;

use Illuminate\Database\Eloquent\SoftDeletes;

class OrderPayPelunasan extends Model
{
    use SoftDeletes;

    public $table = "order_pay_pelunasans";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $guarded = 
    [
       
    ];

    public function getSingleData($id)
    {			
        return OrderPayPelunasan::where('order_id', $id)
            ->whereNull('deleted_at')
            ->get();
    }


    public function getAllDataByIdAndTime_($id)
    {
    	return OrderPayPelunasan::where('order_id', $id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC')
            ->get();
    }
    public function getAllDataByIdAndTime($id)
    {
    	return OrderPayPelunasan::where('order_id', $id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC')
            ->first();
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public static function boot()
    {
        parent::boot();
    }
}
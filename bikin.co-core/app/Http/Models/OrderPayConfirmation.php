<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use App\Http\Models\Order;

use App\Http\Models\LogOrderPaymentConfirmation;

use App\Http\Models\Customer;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\DB;

class OrderPayConfirmation extends Model
{
    use SoftDeletes;

    protected $table = "order_payments";
    protected $soft_delete = true;
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = 
    [
       
    ];

    public function getSingleData($id)
    {		
        return OrderPayConfirmation::where('order_id', $id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getSingleDataLog($id)
    {       
        return LogOrderPaymentConfirmation::where('order_id', $id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getSingleDataNonArray($id)
    {       
        return OrderPayConfirmation::where('order_id', $id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC')
            ->first();
    }


    public function getDataOrder($id)
    {
        return Order::where('id', $id)
            ->whereNull('deleted_at')
            ->get();
    }

    public function getDataByKonfirmasi()
    {
        return OrderPayConfirmation::where('status', '=', 3)->where('is_dp', 2) 

            ->whereNull('deleted_at')
            ->get();
    }

    public function getDataVerifikasi()
    {
        return Order::with('OrderPayConfirmation', 'Customer')
            ->whereHas('orderPayConfirmation', function ($query) {
                return $query->where('status', '=', 3)->where('is_dp', '=', 2);
            })
            ->whereNull('deleted_at')
            ->get();
    }

    public function getDataVerifikasiPelunasan()
    {
        $data = Order::with('OrderPayConfirmation', 'Customer')
            ->whereHas('orderPayConfirmation', function ($query) {
                return $query->where('status', '=', 3)->where('type', '=', 2)->where('is_dp', '=', 1);
            })
            ->whereNull('deleted_at')
            ->get();

            return $data;

    }
    public function getDataByKonfirmasiPelunasan()
    {

        return  Order::with('OrderPayConfirmation', 'Customer')
            ->whereHas('orderPayConfirmation', function ($query) {
                return $query->where('type', '=', '2')->where('is_dp', '=', '1');
            })
            ->whereNull('deleted_at')
            ->get();
    }


    public function getAllDataByIdAndTime_($id)
    {
    	return OrderPayConfirmation::where('order_id', $id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC')
            ->get();
    }
    public function getAllDataByIdAndTime($id)
    {
    	return OrderPayConfirmation::where('order_id', $id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC')
            ->first();
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function logOrder()
    {
        return $this->hasMany(LogOrderPaymentConfirmation::class);
    }

    public static function boot()
    {
        parent::boot();
    }
}
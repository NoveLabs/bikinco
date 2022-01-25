<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use App\Http\Models\Order;

use App\Http\Models\OrderPaymentLog;

use App\Http\Models\Customer;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\DB;

class OrderPayment extends Model
{
    use SoftDeletes;

    protected $soft_delete = true;
    public $timestamps = true;

    protected $guarded = 
    [
       
    ];

    public function scopeGetSingleData($query, $id)
    {		 
        return $query->select([
            'id',
            'order_id',
            queryFormatPhotoWithAlias('proof_payment', 'orderpaymentpath',[''=>'proof_payment','sm'=>'proof_payment_sm','xs'=>'proof_payment_xs']),
            queryFormatPhotoWithAlias('proof_payment_pelunasan', 'orderpaymentpath',[''=>'proof_payment_pelunasan','sm'=>'proof_payment_pelunasan_sm','xs'=>'proof_payment_pelunasan_xs']),
            queryFormatPhotoWithAlias('proof_payment_dp', 'orderpaymentpath',[''=>'proof_payment_dp','sm'=>'proof_payment_dp_sm','xs'=>'proof_payment_dp_xs']),
            'proof_payment_date',
            'due_date',
            'type',
            'status',
            'is_dp',
            'payment_total',
            'created_at'
            ])
            ->where('order_id', $id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC');
    }

    public function getSingleDataLog($id)
    {       
        return OrderPaymentLog::where('order_id', $id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getSingleDataNonArray($id)
    {       
        return OrderPayment::where('order_id', $id)
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


    public function getAllDataByIdAndTime_($id)
    {
    	return OrderPayment::where('order_id', $id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC')
            ->get();
    }
    public function getAllDataByIdAndTime($id)
    {
    	return OrderPayment::where('order_id', $id)
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
        return $this->hasMany(OrderPaymentLog::class, 'order_payment_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
    }
}
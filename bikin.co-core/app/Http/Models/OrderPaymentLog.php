<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use App\Http\Models\OrderPayment;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\DB;

class OrderPaymentLog extends Model
{
    use SoftDeletes;

    protected $soft_delete = true;
    public $timestamps = true;

    protected $guarded = 
    [
       
    ];

    public function getSingleData($id)
    {		
        return OrderPaymentLog::where('order_id', $id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

     public function scopeGetAllDataByIdAndTime_($query, $id)
    {
        return $query->select([
            \DB::raw('DATE_FORMAT(order_payment_logs.created_at, "%W, %d %b %Y %h:%i")  as log_created_at'),
            'order_payment_logs.order_payment_id',
             queryFormatPhotoWithAlias('proof_payment', 'orderpelunasanpath',[''=>'proof_payment','sm'=>'proof_payment_sm','xs'=>'proof_payment_xs']),
            'order_payment_logs.type as log_type',
            'order_payment_logs.status as log_status',
            'order_payment_logs.is_dp as log_is_dp',
            'order_payment_logs.reason as log_reason',
            ])
            ->where('order_payment_id', $id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC')
            ->get();
    }
    public function getAllDataByIdAndTime($id)
    {
        return OrderPaymentLog::where('order_id', $id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC')
            ->first();
    }


    public function orderPayment()
    {
        return $this->belongsTo(OrderPayment::class)->select(array('id', 'proof_payment'));
    }

    public static function boot()
    {
        parent::boot();
    }
}
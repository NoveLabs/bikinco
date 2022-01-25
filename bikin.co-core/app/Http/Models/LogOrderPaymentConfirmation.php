<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use App\Http\Models\OrderPayConfirmation;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\DB;

class LogOrderPaymentConfirmation extends Model
{
    use SoftDeletes;

    public $table = "order_payment_logs";
    protected $primaryKey = 'id';
    protected $soft_delete = true;
    public $timestamps = true;

    protected $guarded = 
    [
       
    ];

    public function getSingleData($id)
    {		
        return LogOrderPaymentConfirmation::where('order_id', $id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

     public function getAllDataByIdAndTime_($id)
    {
        return LogOrderPaymentConfirmation::where('order_id', $id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC')
            ->get();
    }
    public function getAllDataByIdAndTime($id)
    {
        return LogOrderPaymentConfirmation::where('order_id', $id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC')
            ->first();
    }


    public function orderPayment()
    {
        return $this->belongsTo(OrderPayConfirmation::class);
    }

    public static function boot()
    {
        parent::boot();
    }
}
<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class OrderLog extends Model
{

    public $table = "order_logs";
    public $timestamps = true;

    protected $guarded = [
    ];

    public function scopeGetDataLogAll($query)
    {
        return $query->select([
           		'order_id',
           		'flow_step',
           		'title',
           		\DB::raw('DATE_FORMAT(order_logs.flow_step_date, "%a, %d %b %Y") as tgl_log'),
           		\DB::raw('DATE_FORMAT(order_logs.flow_step_date, "%H:%i") as time_log'),
           		'current_description',
           		'next_description',
                ])
            ->leftJoin('order_log_masters', 'order_log_masters.flow_step_id', '=', 'order_logs.flow_step')
            ->orderBy('order_logs.flow_step_date', 'DESC')
            ;
    }

    public function getDataLogAllById($id)
    {
        return OrderLog::select([
              'order_id',
              'flow_step',
              'title',
              \DB::raw('DATE_FORMAT(order_logs.flow_step_date, "%a, %d %b %Y") as tgl_log'),
              \DB::raw('DATE_FORMAT(order_logs.flow_step_date, "%H:%i") as time_log'),
              'current_description',
              'next_description',
                ])
            ->leftJoin('order_log_masters', 'order_log_masters.flow_step_id', '=', 'order_logs.flow_step')
            ->where('order_id', $id)
            ->orderBy('order_logs.flow_step_date', 'DESC')
            ->first()
            ;
    }

    public function getDataLogById($id)
    {
    return OrderLog::select([
          'order_id',
          'flow_step',
          'title',
          \DB::raw('DATE_FORMAT(order_logs.flow_step_date, "%a, %d %b %Y") as tgl_log'),
          \DB::raw('DATE_FORMAT(order_logs.flow_step_date, "%H:%i") as time_log'),
          'current_description',
          'next_description',
            ])
        ->leftJoin('order_log_masters', 'order_log_masters.flow_step_id', '=', 'order_logs.flow_step')
        ->where('order_id', $id)
        ->orderBy('order_logs.flow_step_date', 'DESC')
        ->get()
        ;
    }
    public static function boot()
    {
        parent::boot();
    }
}
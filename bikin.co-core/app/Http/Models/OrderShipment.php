<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class OrderShipment extends Model
{

    public $table = "order_shipments";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = ['order_id','weight','expedition_name','price'];


    /**
     * [scopeGetDataByOrder description]
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeGetAll($query)
    {
        return $query
            ->select([
                'order_shipments.id',
                'order_shipments.order_id',
                'order_shipments.expedition_name',
                'order_shipments.weight',
                'order_shipments.price',
            ]);
            // ->where('order_id',$orderId);
    }

    public function order()
    {
      return $this->hasOne(Order::class, 'id', 'order_id');
    }

    /**
     * [boot description]
     * @return [type] [description]
     */
    public static function boot()
    {
        parent::boot();
    }
}

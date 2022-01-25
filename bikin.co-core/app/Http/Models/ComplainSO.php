<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplainSO extends Model
{
    use SoftDeletes;

    public $table = "complain_so";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $guarded = [

    ];

    public function orders()
    {
        return $this->belongsTo(Order::class);
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


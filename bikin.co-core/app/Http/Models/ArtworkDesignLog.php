<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\SoftDeletes;

class ArtworkDesignLog extends Model
{
    use SoftDeletes;

    public $table = "artwork_design_log";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $guarded = [
    ];

    public static function boot()
    {
        parent::boot();
    }
}
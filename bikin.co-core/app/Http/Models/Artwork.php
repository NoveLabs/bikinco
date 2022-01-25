<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artwork extends Model
{
    use SoftDeletes;

    public $table = "artworks";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'name', 'status'
    ];

    public function getAllData()
    {
        return Artwork::whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return Artwork::
                    where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
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


<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtworkSize extends Model
{
    use SoftDeletes;

    public $table = "artwork_size";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $fillable = [
        'artwork_id', 'size', 'is_custom', 'width', 'height', 'status'
    ];

    public function getAllData()
    {
        return ArtworkSize::
                    whereNull('deleted_at')
                    ->get();
    }

    public function getSingleData($id)
    {
        return ArtworkSize::
                    where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();
    }

    public function getTotalDataByArtwork($id)
    {
        return ArtworkSize::where('artwork_id', $id)
                    ->whereNull('deleted_at')
                    ->count();
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

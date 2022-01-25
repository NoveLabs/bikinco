<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class VerifikasiArtwork extends Model
{

    public $table = "verifikasi_artwork_designs";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $guarded = [
    ];

    public function getSingleData($id)
    {
    	return VerifikasiArtwork::all()->where('order_id', $id)->first();
    }

    public static function boot()
    {
        parent::boot();
    }
}

<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductArtworkPrintType extends Model
{
    use SoftDeletes;
    protected $table = 'artwork_print_types';
    public $timestamps = true;
    public $soft_delete = true;
}

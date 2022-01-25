<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductArtworkPrintMethod extends Model
{
    use SoftDeletes;
    protected $table = 'artwork_print_methods';
    public $timestamps = true;
    private $soft_delete = true;
}

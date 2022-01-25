<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
     public $table = "categories";

     protected $guarded = [ ];

    public function getDataCategories()
    {
        return Categories::select([
            'categories.id',
            'categories.name'
            ])
            ->get();
    }
}

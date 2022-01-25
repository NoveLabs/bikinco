<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    public function hasCategories()
    {
        return $this->hasOne('\App\Http\Models\Category', 'id', 'categories_id');
    }

}
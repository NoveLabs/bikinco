<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Models extends Model
{
    // Use SoftDeletes
    use SoftDeletes;

    // Declare table, soft_delete, timestamps
    public $table = 'models';
    public $timestamps = true;
    public $soft_delete = true;

    // Declare fillable items
    protected $fillable = ['name', 'product_id', 'status'];

    // Get All Variants
    public function getAllModels()
    {
        // Get All Subvariants Data
        $source = Models::with('hasProduct')
                        ->with('hasVariant')
                        ->with('hasSubvariant')
                        ->where('deleted_at', null)
                        ->get();
        
        // Send the $source Data
        return $source;
    }

    // Get Specified Data
    public function getSpecifiedModel($id)
    {
        // Get Model Data by ID
        $source = Models::with('hasProduct')
                        ->with('hasVariant')
                        ->with('hasSubvariant')
                        ->where('id', $id)
                        ->where('deleted_at', null)
                        ->get();
        
        // Send the $source Data
        return $source;
    }

    // Get Active Variants
    public function getActiveModels($status = 1)
    {
        // Get All Active Models
        $source = Models::with('hasProduct')
                        ->with('hasVariant')
                        ->with('hasSubvariant')
                        ->where('status', $status)
                        ->where('deleted_at', null)
                        ->get();
        
        // Send the $source data
        return $source;
    }


    // Relation : Categories
    public function hasProduct()
    {
        // Declare Relation
        return $this->hasOne('\App\Http\Models\Product', 'id', 'product_id');
    }

    public function hasVariant()
    {
        // Declare Relation
        return $this->hasOne('\App\Http\Models\Variant', 'id', 'variant_id');
    }

    public function hasSubvariant()
    {
        // Declare Relation
        return $this->hasOne('\App\Http\Models\Subvariant', 'id',
            'subvariant_id');
    }
}

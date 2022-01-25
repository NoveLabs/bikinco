<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subvariant extends Model
{
    // Use SoftDeletes
    use SoftDeletes;

    // Declare table, soft_delete, timestamps
    public $table = 'subvariants';
    public $timestamps = true;
    public $soft_delete = true;
    
    // Declare fillable item
    protected $fillable = ['name', 'product_id', 'status'];

    // Get All Variants
    public function getAllSubvariants()
    {
        // Get All Subvariants Data
        $source = Subvariant::with('hasProduct')
                            ->with('hasVariant')
                            ->where('deleted_at', null)
                            ->get();
        
        // Send the $source Data
        return $source;
    }

    // Get Specified Data
    public function getSpecifiedSubvariant($id)
    {
        // Get Subvariant Data By ID
        $source = Subvariant::with('hasProduct')
                            ->with('hasVariant')
                            ->where('id', $id)
                            ->where('deleted_at', null);
    
        // Send the $source Data
        return $source;
    }

    // Get Active Variants
    public function getActiveSubvariants($status = 1)
    {
        // Get All Active Subvariants
        $source = Subvariant::with('hasProduct')
                            ->with('hasVariant')
                            ->where('status', $status)
                            ->where('deleted_at', null);
    
        // Send the $source Data
        return $source;
    }

    // Relation : Categories
    public function hasProduct()
    {
        // Declare relation
        return $this->hasOne('\App\Http\Models\Product', 'id', 'product_id');
    }

//
    public function hasVariant()
    {
        // Declare relation
        return $this->hasOne('\App\Http\Models\Variant', 'id', 'variant_id');
    }
}

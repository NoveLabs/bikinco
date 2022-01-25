<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    // Use SoftDeletes
    use SoftDeletes;

    // Declare table, soft_delete, timestamps
    public $table = 'variants';
    public $timestamps = true;
    public $soft_delete = true;

    // Declare fillable items
    protected $fillable = ['name', 'product_id', 'status'];

    // Get All Variants
    public function getAllVariants()
    {
        // Get All Active Variants
        $source = Variant::with('hasProduct')
                         ->where('deleted_at', null)
                         ->get();
    
        // Send the $source data
        return $source;
    }

    // Get Specified Data
    public function getSpecifiedVariant($id)
    {
        // Get Active Variant Source by ID
        $source = Variant::with('hasProduct')
                         ->where('id', $id)
                         ->where('deleted_at', null);
    
        // Send the $source data
        return $source;
    }

    // Get Active Variants
    public function getActiveVariants($status = 1)
    {
        // Get Active Variant Source
        $source = Variant::with('hasProduct')
                         ->where('status', $status)
                         ->where('deleted_at', null)
                         ->get();
        
        // Send the $source data
        return $source;
    }

    // Relation : Categories
    public function hasProduct()
    {
        // Declare the relation
        return $this->hasOne('\App\Http\Models\Product', 'id', 'product_id');
    }
}
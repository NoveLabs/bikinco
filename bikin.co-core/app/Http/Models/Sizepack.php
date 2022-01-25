<?php
    
    namespace App\Http\Models;
    
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    use App\Http\Models\Vendor;
    
    class Sizepack extends Model
    {
        // Use SoftDeletes
        use SoftDeletes;
        
        // Declare table, soft_delete, timestamps
        public $table = 'sizepacks';
        public $timestamps = true;
        public $soft_delete = true;
        
        // Declare fillable items
        protected $fillable = [
            'vendor_name',
            'size_code',
            'status',
            'file',
        ];
    
        // Get All Variants
        public function getLatestSizepacks()
        {
            // Get All Subvariants Data
            $source = Sizepack::whereNull('deleted_at')
                              ->latest('created_at')
                              ->get();
        
            // Send the $source Data
            return $source;
        }
        
        // Get All Variants
        public function getAllSizepacks()
        {
            // Get All Subvariants Data
           $source = Sizepack::whereNull('deleted_at')
                              ->get();
            
            // Send the $source Data
            return $source;
        }
        
        // Get Specified Data
        public function scopeGetSpecifiedSizepacks($query, $id)
        {
            // Get Model Data by ID
            return $query->select([
                'id',
                'vendor_name',
                'vendor_id',
                'size_code',
                'status',
                queryFormatPhotoWithAlias('file', 'pengaturansizepackpath',[''=>'file','sm'=>'file_sm','xs'=>'file_xs']),
                ])
                ->where('id', $id);
            
        }
        
        // Get Active Variants
        public function getActiveModels($status = 1)
        {
            // Get All Active Models
            $source = Sizepack::whereNull('deleted_at')
                              ->where('status', $status);
            
            // Send the $source data
            return $source;
        }

        public function getDataVendor()
        {
            return Vendor::whereNull('deleted_at')->get();
        }

        public function vendor()
        {
            return $this->hasOne('\App\Http\Models\Sizepack', 'id', 'vendor_name');
        }
        
    }

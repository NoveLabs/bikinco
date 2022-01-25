<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimoni extends Model
{
	use softDeletes;

    public $table = "testimony";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $guarded = [ ];

    public function getAll()
    {
    	return Testimoni::select('testimony.id', 'company_name', 'testimony', 'rating', 'testimony.status', 'company_id')
    	->whereNull('testimony.deleted_at')
    	->join('company', 'company.id', '=', 'testimony.company_id');
    }

    public function getSingleData($id)
    {
    	return Testimoni::select('testimony.id', 'company_name', 'testimony', 'rating', 'company_id', 'testimony.status')
    	->where('testimony.id', $id)
    	->join('company', 'company.id', '=', 'testimony.company_id')
    	->whereNull('testimony.deleted_at')
    	->first();
    }
}

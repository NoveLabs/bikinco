<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
	use softDeletes;

    public $table = "company";
    protected $soft_delete = true;
    public $timestamps = true;
    protected $guarded = [ ];

    public function scopeGetAllRecord($query)
    {
        return $query->select([
            'id',
            'company_name',
            queryFormatPhotoWithAlias('company_logo', 'companypath',[''=>'company_logo','sm'=>'company_logo_sm','xs'=>'company_logo_xs']),

            ])
            ->whereNull('deleted_at');
    }

    public function scopeGetSingleRecord($query, $id)
    {
        return $query->select([
            'id',
            'company_name',
            queryFormatPhotoWithAlias('company_logo', 'companypath',[''=>'company_logo','sm'=>'company_logo_sm','xs'=>'company_logo_xs']),
            ])
            ->where('id', $id)
            ->whereNull('deleted_at');

    }

    public function getAll()
    {
    	return Company::whereNull('deleted_at');
    }

    public function getSingleData($id)
    {
    	return Company::where('id', $id)->whereNull('deleted_at')->first();
    }
}

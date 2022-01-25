<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AtworkPrintMethod extends Model
{
    use SoftDeletes;

    public $table = "artwork_print_methods";
    protected $soft_delete = true;
    public $timestamps = true;

    protected $guarded = [];

    public function getAllData()
    {
        return AtworkPrintMethod::whereNull('deleted_at')
                    ->get();
    }

    /**
     * [boot description]
     * @return [type] [description]
     */
    public static function boot()
    {
        parent::boot();
    }
}

<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Userlog extends Model
{
    protected $table = 'users_logs';
    protected $fillable = ['user_id','ip','platform','browser','description'];
}

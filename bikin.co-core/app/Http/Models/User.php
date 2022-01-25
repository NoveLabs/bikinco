<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $table = 'users';
    protected $guarded = [];


    public function getSingleData($id)
    {
    	return User::join('users_roles', 'users_roles.user_id', '=', 'users.id')->where('id', $id)->first();
    }
}

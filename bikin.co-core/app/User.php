<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function roles() 
    {
        return $this->belongsToMany('App\Http\Models\Role','users_roles');
    }
    
    public function logs()
    {
        return $this->hasMany('App\Http\Models\Userlog', 'user_id');
    }

    public function lastLog(){
        return $this->hasMany('App\Http\Models\Userlog', 'user_id')->orderby('id', 'DESC')->limit(1)->get();
    }

    public function getImagesAttribute($image){
        $defaultImage = asset('images/defaultuser.png');
        if ($image) {
            $userImage = asset('images/user/' .$image);
                if(file_exists(public_path('images/user/') . $image)){
                return $userImage;
            }
                if (filter_var($image, FILTER_VALIDATE_URL)) {
                return $image;
            }
        }
        return $defaultImage;
    }
}

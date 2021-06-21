<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\Config;

class User extends Authenticatable
{
    protected $imgDirectory = "uploads" . DIRECTORY_SEPARATOR . "profiles";
    protected $appends = ["imgPath"];

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', "username"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany("App\Post");
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class, "permission_user");
    }

    public function roles(){
        return $this->belongsToMany(Role::class, "user_role");
    }

    public function setPasswordAttribute($value){
        $this->attributes["password"] = Hash::make($value);
    }
    public function getImgPathAttribute(){
        return DIRECTORY_SEPARATOR . $this->imgDirectory . DIRECTORY_SEPARATOR . $this->id;
    }
}

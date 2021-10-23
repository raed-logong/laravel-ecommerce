<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravelista\Comments\Commenter;


class User extends \TCG\Voyager\Models\User
{
    use Notifiable,Commenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded=[];
    protected $fillable = [
        'name', 'email', 'password','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function profile(){
        return $this->hasOne('App\Profile');
    }
    public function products(){
        return $this->hasMany('App\Product');
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    public function following(){
        return $this->belongsToMany('App\Profile');
    }
}

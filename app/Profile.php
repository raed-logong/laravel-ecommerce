<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable=['image','description','address'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function followers(){
        return $this->belongsToMany('App\User');
    }
}

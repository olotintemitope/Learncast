<?php

namespace LearnCast;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username','email','password','picture_url','profile_bio','role_id','remember_token','provider_id','provider',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function videos()
    {
        return $this->hasMany('LearnCast\Video');
    }

    public function categories()
    {
        return $this->hasMany('LearnCast\Category');
    }

    public function comments()
    {
        return $this->hasMany('LearnCast\Comment');
    }

    public function favourites()
    {
        return $this->hasMany('LearnCast\Favourite');
    }
}

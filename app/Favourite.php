<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $fillable = ['user_id', 'video_id'];

    public function video()
    {
        return $this->belongsTo('App/Video');
    }
}

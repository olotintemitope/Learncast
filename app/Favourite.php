<?php

namespace LearnCast;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $fillable = ['user_id', 'video_id'];

    public function video()
    {
        return $this->belongsTo('LearnCast\Video');
    }

    public function user()
    {
        return $this->belongsTo('LearnCast\User');
    }

    public function scopeGetVideoFavouritedByUser($query, $id)
    {
        return $query->where('user_id', '=', $id);
    }
}

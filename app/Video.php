<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'url', 'description', 'category_id', 'user_id', 'views', 'favourites'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function favourite()
    {
        return $this->hasMany('App\Favourite');
    }

    public function scopeGetVideosByUserId($query, $id)
    {
        return $query->where('videos.user_id', '=', $id);
    }

    public function scopeAllTrashedVideos($query, $id)
    {
        return $query
        ->where('videos.user_id', '=', $id)
        ->onlyTrashed();
    }

    public function scopeGetVideoById($query, $id)
    {
        return $query->where('videos.id', '=', $id);
    }

    public function scopeSetVideoStatus($query, $id)
    {
        return $query->find($id);
    }
}

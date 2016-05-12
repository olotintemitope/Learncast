<?php

namespace LearnCast;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'url', 'description', 'category_id', 'user_id', 'views', 'favourites'];

    public function category()
    {
        return $this->belongsTo('LearnCast\Category');
    }

    public function user()
    {
        return $this->belongsTo('LearnCast\User');
    }

    public function comments()
    {
        return $this->hasMany('LearnCast\Comment');
    }

    public function favourite()
    {
        return $this->hasMany('LearnCast\Favourite');
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

    public function scopeGetRelatedVideo($query, $id, $catId, $search)
    {
        return $query
        ->whereNotIn('videos.id', [$id])
        ->where('videos.category_id', $catId)
        ->select(DB::raw('videos.*', 'videos.title like '.'%'.$search.'%'));
    }

    public function scopeGetVideoLike($query, $search)
    {
        return $query
        ->where('videos.title', 'like', '%'.$search.'%')
        ->orWhere('videos.description', 'like', '%'.$search.'%');
    }
}

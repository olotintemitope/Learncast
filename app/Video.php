<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable  = ['title', 'url', 'description', 'category_id', 'user_id'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeGetVideosByUserId($query, $id)
    {
        return $query 
        ->where('videos.user_id', '=', $id);
    }

    public function scopeAllTrashedVideos($query, $id)
    {
        return $query 
        ->where('videos.user_id', '=', $id)
        ->onlyTrashed();
    }

    public function scopeGetVideoById($query, $id)
    {
        return $query->where('id', '=', $id);
    }

    public function scopeSetVideoStatus($query, $id)
    {
        return $query->find($id);
    }
}

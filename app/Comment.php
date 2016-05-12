<?php

namespace LearnCast;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'user_id', 'video_id'];

    public function video()
    {
        return $this->belongsTo('LearnCast\Video');
    }

    public function user()
    {
        return $this->belongsTo('LearnCast\User');
    }

    public function scopeRemoveComment($query, $id)
    {
        return $query->where('id', $id);
    }
}

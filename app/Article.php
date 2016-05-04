<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $dates = ['published_at'];

    protected $fillable = [

        'title',
        'body',
        'published_at',

    ];

    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeUnpublished($query)
    {
        $query->where('published_at', '>=', Carbon::now());
    }

    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
    }
}

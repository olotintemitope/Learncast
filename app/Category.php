<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable  = ['name', 'description', 'user_id'];

    public function videos()
    {
        return $this->hasMany('App\Video');
    }

    public function scopeGetCategoriesByUserId($query, $id)
    {
        return $query->where('user_id', '=', $id);
    }

    public function scopeAllTrashedCategories($query, $id)
    {
        return $query
        ->where('user_id', '=', $id)
        ->onlyTrashed();
    }

    public function scopeGetCategoryById($query, $id)
    {
        return $query->where('id', '=', $id);
    }

    public function scopeSetCategoryStatus($query, $id)
    {
        return $query->find($id);
    }
}

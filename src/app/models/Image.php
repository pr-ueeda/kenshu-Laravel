<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['image_url'];

    public function article() {
        return $this->belongsToMany('App\Models\Article', 'article_images');
    }
}

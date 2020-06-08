<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsToMany('App\Models\User', 'user_articles');
    }

    public function tag() {
        return $this->belongsToMany('App\Models\Tag', 'article_tags');
    }

    public function image() {
        return $this->belongsToMany('App\Models\Image', 'article_images');
    }

    public function thumbnail() {
        return $this->hasOne('App\Models\Thumbnail');
    }
}

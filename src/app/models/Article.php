<?php

namespace App\Models;

use App\BaseModel;

class Article extends BaseModel
{
    public static $rules = [];

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = ['article_id'];

    public function user() {
        return $this->belongsToMany('App\Models\User', 'user_articles');
    }

    public function tag() {
        return $this->belongsToMany('App\Models\Tag', 'article_tags');
    }
}

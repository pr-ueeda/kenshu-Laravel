<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function article() {
        return $this->belongsToMany('App\Models\Article', 'article_images');
    }
}

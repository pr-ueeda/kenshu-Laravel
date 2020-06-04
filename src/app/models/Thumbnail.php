<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thumbnail extends Model
{
    protected $fillable = ['image_id', 'article_id'];

    public function image() {
        return $this->belongsTo('App\Models\Image');
    }
}

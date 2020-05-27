<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['id', 'tag_name', 'updated_at'];

    public function article() {
        return $this->belongsToMany('App\Models\Article', 'article_tags');
    }
}

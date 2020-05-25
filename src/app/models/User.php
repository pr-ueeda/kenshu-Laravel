<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = ['id', 'created_at'];

    public function articles()
    {
        return $this
            ->belongsToMany('App\Models\Article')
            ->using('App\UserArticle');
    }
}

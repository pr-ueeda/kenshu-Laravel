<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Model implements Authenticatable
{
    use AuthenticableTrait;

    protected $fillable = ['name', 'email', 'password'];

    public function article() {
        return $this->belongsToMany('App\Models\Article', 'user_articles');
    }
}

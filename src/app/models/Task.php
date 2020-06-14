<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['user_id', 'task_name'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

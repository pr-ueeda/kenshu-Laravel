<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class BaseModel extends Model
{
    public $errors;

    public function validator() {

        $validator = Validator::make($this->attributes, static::$rules);

        if ($validator->passes()) return true;

        $this->errors = $validator->messages();

        return false;
    }
}

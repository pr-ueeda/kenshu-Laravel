<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAndUpdateRequestValidation extends FormRequest
{
    // バリデーションのルール設定
    public function rules()
    {
        return [
            'title' => 'required',
            'tags' => 'required',
            'body' => 'required',
            'up_file' => 'required'
        ];
    }
}

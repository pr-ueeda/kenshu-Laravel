<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

/**
 * Class BaseModel
 * @package App
 *
 * Modelを継承したClassでバリデーションについての処理が書かれています。
 * このクラスをモデルの定義をするクラス(今回だとmodelsディレクトリ以下)で継承させ
 * バリデーションのテストをやりやすくしています。今回は記事投稿時のバリデーションは必須なので
 * Articleクラスのみに継承させて、バリデーションテストを作成しました。
 */
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

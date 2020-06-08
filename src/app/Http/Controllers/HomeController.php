<?php

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        // ログインしているユーザーのid取得
        // 各モデルファイルで定義しているリレーションを使ってデータ取得しようとしましたが、
        // ユーザーに紐づいた記事が1つしか取得することができなかったので、この形で処理を行っています。
        $user_id = Auth::id();
        $user_articles = DB::table('articles')
            ->join('user_articles', 'articles.id', '=', 'user_articles.article_id')
            ->join('users', 'users.id', '=', 'user_articles.user_id')
            ->select('title', 'articles.updated_at', 'user_articles.article_id')
            ->whereIn('user_articles.user_id', [$user_id])
            ->get();

        return \view('home', ['user_articles' => $user_articles]);
    }
}

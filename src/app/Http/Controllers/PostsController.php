<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAndUpdateRequestValidation;
use App\Models\Thumbnail;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;
use App\functions;

class PostsController extends Controller
{
    private $splitAndSave;

    // テストをしやすくするためにコントラクタインジェクションを実装
    public function __construct(functions\SplitSave $splitAndSave)
    {
        $this->splitAndSave = $splitAndSave;
    }

    public function index()
    {
        return view('posts');
    }

    public function store(StoreAndUpdateRequestValidation $request)
    {

        // ログインしているユーザーのID取得
        $user_id = Auth::id();

        // formから送られてきたデータを変数に代入
        $title = $request->input('title');
        $body = $request->input('body');

        // articlesテーブルにinsert
        $result = Article::create([
            'title' => $title,
            'body' => $body
        ]);

        $tag_ids = $this->splitAndSave->splitSaveTags($request->input('tags'));
        $image_ids = $this->splitAndSave->splitSaveImages($images = $request->file('up_file'));

        // 最後に追加されたarticleのid取得
        $last_insert_id = $result->id;

        $user = User::find($user_id);
        // 中間テーブルarticle_usersにインサート
        $user->article()->attach($last_insert_id);

        // 中間テーブルarticle_tagsにインサート
        $article = Article::find($last_insert_id);
        $article->tag()->attach($tag_ids);

        // 中間テーブルarticle_imagesにインサート
        $article->image()->attach($image_ids);

        $first_image_id = $image_ids[0];
        Thumbnail::create([
            'image_id' => $first_image_id,
            'article_id' => $last_insert_id
        ]);

        return redirect('/home')->with('success', '投稿しました。');
    }

}



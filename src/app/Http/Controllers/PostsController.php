<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index()
    {
        return view('posts');
    }

    public function store(Request $request)
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

        // タグをformから取得し、#で区切って代入
        $tags_name = explode('#', $request->input('tags'));
        $tag_ids = [];
        // 区切った分を回しつつ、Tagsテーブルに格納し、格納したidを配列に代入
        foreach ($tags_name as $tag_name) {
            if (!empty($tag_name)) {
                $tag_insert = \App\Models\Tag::firstOrCreate([
                    'tag_name' => $tag_name,
                ]);
                $tag_ids[] = $tag_insert->id;
            }
        }

        $images_id = [];
        $images = $request->file('up_file');
        foreach ($images as $image) {
            $path = $image->storeAs('/images', 'userid='. $user_id . '.png');
            $image_insert = \App\Models\Image::firstOrCreate([
                'image_url' => $path
            ]);
            $images_id[] = $image_insert->id;
        }

        // 最後に追加されたarticleのid取得
        $last_insert_id = $result->id;

        $user = User::find($user_id);
        // 中間テーブルarticle_usersにインサート
        $user->article()->attach($last_insert_id);

        // 中間テーブルarticle_tagsにインサート
        $article = Article::find($last_insert_id);
        $article->tag()->attach($tag_ids);

        $article->image()->attach($images_id);

        return redirect('/')->with('success', '投稿しました。');
    }
}

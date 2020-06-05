<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAndUpdateRequestValidation;
use App\Models\Thumbnail;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
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
            // public/imagesフォルダへ保存
            $save_path = Storage::disk('local')->putFile('public/images', $image, 'public');
            // 保存先のパスから参照先のパスへ置換
            $reference_path = str_replace('public', 'storage', $save_path);
            $image_insert = \App\Models\Image::firstOrCreate([
                'image_url' => '/' . $reference_path
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

        // 中間テーブルarticle_imagesにインサート
        $article->image()->attach($images_id);

        $first_image_id = $images_id[0];
        Thumbnail::create([
            'image_id' => $first_image_id,
            'article_id' => $last_insert_id
        ]);

        return redirect('/home')->with('success', '投稿しました。');
    }

}



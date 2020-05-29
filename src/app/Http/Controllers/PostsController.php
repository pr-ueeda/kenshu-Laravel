<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use App\Models\Article;
use App\Models\Tag;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // formから送られてきたデータを変数に代入
        $title = $request->input('title');
        $body = $request->input('body');

        // articlesテーブルにinsert
        $result = Article::create([
            'title' => $title,
            'body' => $body
        ]);

        var_dump($request->file('up_file'));

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
        var_dump($images);
        foreach ($images as $image) {
            $path = $image->store('images');
            $image_insert = \App\Models\Image::firstOrCreate([
                'image_url' => $path
            ]);
            $images_id[] = $image_insert->id;
        }

        // 最後に追加されたarticleのid取得
        $last_insert_id = $result->id;

        // ログインしているユーザーのID取得
        $user_id = Auth::id();
        $user = User::find($user_id);
        // 中間テーブルarticle_usersにインサート
        $user->article()->attach($last_insert_id);

        // 中間テーブルarticle_tagsにインサート
        $article = Article::find($last_insert_id);
        $article->tag()->attach($tag_ids);

        $article->image()->attach($images_id);

        return redirect('/home')->with('success', '投稿しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

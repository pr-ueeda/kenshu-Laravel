<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class ArticleController extends Controller
{
    public function show($id)
    {
        $article = Models\Article::find($id);
        $article_users = $article->user;
        $article_images = $article->image;
        $article_tags = $article->tag;

        return \view('article', [
            'article' => $article,
            'article_users' => $article_users,
            'article_images' => $article_images,
            'article_tags' => $article_tags
        ]);
    }

    public function edit($id)
    {
        $article = Models\Article::with('user')->find($id);

        return \view('edit', ['article' => $article]);
    }

    public function update(Request $request)
    {
        $article = Models\Article::find($request->id);

        // formから送られてきたデータを変数に代入
        $title = $request->input('title');
        $body = $request->input('body');

        $article->title = $title;
        $article->body = $body;

        $article->save();

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
            $path = $image->store('images');
            $image_insert = \App\Models\Image::create([
                'image_url' => $path
            ]);
            $images_id[] = $image_insert->id;
        }

        // article_tagsテーブルの更新
        $article->tag()->sync($tag_ids);

        // article_imagesテーブルの更新
        $article->image()->sync($images_id);

        return redirect('/')->with('success', '更新しました。');
    }

    public function destroy($id)
    {
        Models\Article::destroy($id);

        return redirect('/')->with('success', '記事を削除しました。');
    }
}

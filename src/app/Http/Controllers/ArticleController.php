<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAndUpdateRequestValidation;
use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Storage;
use App\functions;

class ArticleController extends Controller
{
    private $splitAndSave;

    // テストをしやすくするためにコントラクタインジェクションを実装
    public function __construct(functions\SplitSave $splitAndSave)
    {
        $this->splitAndSave = $splitAndSave;
    }

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

    public function update(StoreAndUpdateRequestValidation $request)
    {
        $article = Models\Article::find($request->id);

        // formから送られてきたデータを変数に代入
        $title = $request->input('title');
        $body = $request->input('body');

        $article->title = $title;
        $article->body = $body;

        $article->save();

        $tag_ids = $this->splitAndSave->splitSaveTags($request->input('tags'));
        $image_ids = $this->splitAndSave->splitSaveImages($images = $request->file('up_file'));

        // article_tagsテーブルの更新
        $article->tag()->sync($tag_ids);

        // article_imagesテーブルの更新
        $article->image()->sync($image_ids);

        return redirect('/')->with('success', '更新しました。');
    }

    public function destroy($id)
    {
        Models\Article::destroy($id);

        return redirect('/home')->with('success', '記事を削除しました。');
    }
}

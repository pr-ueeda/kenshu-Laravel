<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAndUpdateRequestValidation;
use App\Models;
use App\functions;

class ArticleController extends Controller
{
    private $splitRegister;

    // showメソッドでは使わないので、setterでDIするのもいいかと考えましたが、
    // controllerなので、setterメソッドをここで作成するのはMVC的によくないと思い、コンストラクタで依存注入を行いました。
    public function __construct(functions\SplitRegister $splitRegister)
    {
        $this->splitRegister = $splitRegister;
    }

    public function show($id)
    {
        // それぞれ、articleテーブルからリレーションがあるテーブルを呼び出す
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
        // まず、routeからeditへ遷移させる。
        // このタイミングでuserに紐づいている記事のidを取得させ、viewに返す
        $article = Models\Article::with('user')->find($id);

        return \view('edit', ['article' => $article]);
    }

    // バリデーション
    public function update(StoreAndUpdateRequestValidation $request)
    {
        $article = Models\Article::find($request->id);

        // formから送られてきたデータを変数に代入
        $title = $request->input('title');
        $body = $request->input('body');

        $article->title = $title;
        $article->body = $body;

        $article->save();

        // タグの画像を一つずつDBに格納するメソッド呼び出し
        $tag_ids = $this->splitRegister->splitRegisterTags($request->input('tags'));
        $image_ids = $this->splitRegister->splitRegisterImages($images = $request->file('up_file'));

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

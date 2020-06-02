<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models;


class ArticleUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testArticleUpdate()
    {
        // 記事のタイトル、本文、タグ、画像についてそれぞれデータを作成
        $article = factory(Models\Article::class, 1)->create([
                'title' => 'プログラミングについて'
            ]
        );

        $article_tag = factory(Models\Tag::class, 1)->create();

        $article_image = factory(Models\Image::class, 1)->create();

        // 記事のタイトルを置き換えて保存、第一引数と第二引数が等しいか
        $article->fill(['title' => 'コロナウイルスについて']);
        $article->save();
        $this->assertEquals('プログラミングについて', $article->title);

        $article_tag->fill(['image_url' => 'http://images/sample']);
        $article_tag->save();
        $this->assertEquals('http://images/sample', $article_tag->tag_name);

        $article_tag->fill(['tag_name' => 'コロナウイルス']);
        $article_tag->save();
        $this->assertEquals('コロナウイルス', $article_image->image_url);
    }
}

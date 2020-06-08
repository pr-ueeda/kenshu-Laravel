<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models;


class ArticleUpdateTest extends TestCase
{
    use RefreshDatabase;

    protected $article;
    protected $tag;
    protected $image;

    public function setUp(): void
    {
        parent::setUp();

        // それぞれテストデータを作成
        $this->article = factory(Models\Article::class)->create();

        $this->tag = factory(Models\Tag::class)->create();

        $this->image = factory(Models\Image::class)->create();
    }

    public function testArticleUpdate()
    {
        // 記事のタイトルを置き換えて保存、第一引数と第二引数が等しいか
        $this->article->fill(['title' => 'コロナウイルスについて']);
        $this->article->save();
        $this->assertEquals('コロナウイルスについて', $this->article->title);

        $this->tag->fill(['tag_name' => 'php']);
        $this->tag->save();
        $this->assertEquals('php', $this->tag->tag_name);

        $this->image->fill(['image_url' => 'http://sample/sample']);
        $this->image->save();
        $this->assertEquals('http://sample/sample', $this->image->image_url);
    }
}

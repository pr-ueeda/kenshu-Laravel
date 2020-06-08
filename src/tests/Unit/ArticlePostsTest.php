<?php

namespace Tests\Unit;

use App\functions\SplitRegister;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models;

class ArticlePostsTest extends TestCase
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

    public function testHasSaved(): void
    {
        // データベースにsetUpで作成したデータがあるか確認
        $this->assertDatabaseHas('articles', [
            'title' => $this->article->title
        ]);

        $this->assertDatabaseHas('tags', [
            'tag_name' => $this->tag->tag_name
        ]);

        $this->assertDatabaseHas('images', [
            'image_url' =>  $this->image->image_url
        ]);
    }

    // タグと画像(複数入力があるform)のデータを分割してDBに格納するメソッドのテスト
    public function testSplitAndSave()
    {
        // SplitRegisterクラスのsplitSaveTagsメソッドをパーシャルモック化
        $article = $this->createPartialMock(SplitRegister::class, ['splitSaveTags']);

        // パーシャルモックの設定。一回だけでいいので一回だけ呼び出し、
        // 引数に実際のメソッドが受け取る形で指定
        // データベースに保存された後にint型の整数が返ってくるか
        $article->expects($this->once())
            ->method('splitSaveTags')
            ->with($this->equalTo('#tag #tag2'))
            ->willReturn([3, 4]);

        $article->splitSaveTags('#tag #tag2');
    }
}

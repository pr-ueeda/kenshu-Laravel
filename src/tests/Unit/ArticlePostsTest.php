<?php

namespace Tests\Unit;

use App\Http\Controllers\PostsController;
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

    public function testSplitAndSave()
    {
        $article = $this->createPartialMock(PostsController::class, ['splitAndSave']);

        $article->expects($this->once())
            ->method('splitAndSave')
            ->with($this->equalTo('#tag #tag'))
            ->willReturn(3);




    }
}

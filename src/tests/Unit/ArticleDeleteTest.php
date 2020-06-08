<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\Exception;
use Tests\TestCase;
use App\Models;

class ArticleDeleteTest extends TestCase
{
    use RefreshDatabase;

    protected $article;

    protected function setUp(): void
    {
        parent::setUp();

        $this->article = factory(Models\Article::class)->create();
    }

    /**
     * 記事削除テスト
     */
    public function testArticleDelete()
    {
        // 削除
        try {
            $this->article->delete();
        } catch (\Exception $e) {
            throw new Exception($e);
        }

        // titleがプログラミングについてのデータが存在しないか
        $this->assertDatabaseMissing('articles', [
            'id' => $this->article->id
        ]);
    }
}

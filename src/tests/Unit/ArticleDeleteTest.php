<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models;

class ArticleDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function testArticleDelete()
    {
        $article = factory(Models\Article::class, 1)->create([
                'title' => 'プログラミングについて'
            ]
        );

        // 削除
        $article->delete();

        // titleがプログラミングについてのデータが存在しないか
        $this->assertDatabaseMissing('article', [
            'title' => 'プログラミングについて'
        ]);
    }
}

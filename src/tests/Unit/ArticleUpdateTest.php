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
        factory(Models\Article::class, 1)->create([
                'title' => 'プログラミングについて'
            ]
        );

        factory(Models\Tag::class, 1)->create();

        factory(Models\Image::class, 1)->create();

        $this->assertDatabaseHas('articles', [
            'title' => 'プログラミングについて'
        ]);


    }
}

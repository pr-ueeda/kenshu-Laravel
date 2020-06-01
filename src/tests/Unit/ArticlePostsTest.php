<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models;

class ArticlePostsTest extends TestCase
{
    use RefreshDatabase;

    public function testArticlePosts()
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

        $this->assertDatabaseHas('tags', [
            'tag_name' => 'laravel'
        ]);

        $this->assertDatabaseHas('images', [
            'image_url' =>  'http://.......'
        ]);
    }
}

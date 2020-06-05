<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models;

class CanSeeArticleTest extends DuskTestCase
{
    use RefreshDatabase;

    protected $article;

    protected function setUp(): void
    {
        parent::setUp();

        $this->article = factory(Models\Article::class)->create();
    }

    public function testCanSeeArticle()
    {
        $this->visit('/')
            ->assertSee('テスト');
    }
}

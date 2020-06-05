<?php

namespace Tests\Unit;

use Tests\TestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models;

class CanSeeArticleTest extends TestCase
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

    public function testCanSeeArticleDetail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSeeLink('テスト')
                ->clickLink('テスト')
                ->waitForLocation('/article/1', 1)
                ->assertPathIs('/article/1')
                ->assertSee('テスト');
        });
    }
}

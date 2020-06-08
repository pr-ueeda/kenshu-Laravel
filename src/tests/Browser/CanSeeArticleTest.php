<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models;

class CanSeeArticleTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCanSeeArticle()
    {
        $article = factory(Models\Article::class)->create();

        $this->browse(function ($browser) use ($article) {
            $browser->waitForText($article->title, 1)
                ->waitForText($article->body, 1);
        });
    }
}

<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Laravel\Dusk\Browser;

class CanSeeArticleTest extends TestCase
{
    public function testCanSeeArticle()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('テスト');
        });
    }

    public function testCanSeeArticleDetailTest()
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

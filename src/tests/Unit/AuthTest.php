<?php

namespace Tests\Unit;

use App\Models;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ユーザー登録テスト
     */
    public function testRegister()
    {
        // テストユーザー作成
        factory(\App\Models\User::class, 1)->create([
            'email' => 'test@sample.com',
            'password' => 'password'
        ]);

        // DBにemail=test@sample.comのユーザーが存在するかどうか
        $this->assertDatabaseHas('users', [
            'email' => 'test@sample.com'
        ]);
    }

    /**
     * ログイン認証テスト
     */
    public function testLogin()
    {
        // テストユーザー作成
        $user = factory(\App\Models\User::class)->create([
            'email' => 'test@sample.com',
            'password' => 'password'
        ]);

        // 作成したユーザーでログイン
        $response = $this->post('login', [
            'email' => 'test@sample.com',
            'password' => bcrypt('password')
        ]);

        // 認証完了後、/homeへリダイレクトするかどうか
        $response->assertRedirect('/home');

        $this->assertAuthenticated($user);
    }

    /**
     * ログアウトテスト
     */
    public function testLogout()
    {
        // テストユーザー作成
        $user = factory(\App\Models\User::class)->make([
            'email' => 'test@sample.com',
            'password' => 'password'
        ]);

        $this->assertAuthenticated($user);

        $response = $this->actingAs($user);

        $response->post('logout');
    }
}

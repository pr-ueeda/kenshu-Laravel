<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $password = 'password';

    public function setUp(): void
    {
        parent::setUp();

        // userデータを作成
        $this->user = factory(User::class)->create([
            'password' => bcrypt($this->password)
        ]);
    }

    /**
     * ログイン認証テスト
     */
    public function testLogin(): void
    {

        // setUpで作成したユーザーでログイン
        $response = $this->post(route('login'), [
            'email' => $this->user->email,
            'password' => $this->password
        ]);


        // homeにリダイレクトするのか確認
        $response->assertRedirect('/home');

        // ログインしたユーザーで認証されているか
        $this->assertAuthenticatedAs($this->user);
    }

    /**
     * ログアウトテスト
     */
    public function testLogout(): void
    {
        // ログイン済みのユーザーを指定
        $response = $this->actingAs($this->user);

        $response->post(route('logout'));

        // 認証されていないか
        $this->assertGuest();
    }
}

<?php

namespace Tests\Unit;

use App\BaseModel;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class PostsArticleValidationTests extends TestCase
{
    protected $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = $model = new BaseModel;
        $model::$rules = ['title' => 'required'];
    }

    // バリデーションを通過したら、trueを返すテスト
    public function testReturnsTrueIfValidationPasses()
    {
        Validator::shouldReceive('make')->once()->andReturn(
            \Mockery::mock(['passes' => true])
        );

        $this->model->title = 'Title';
        $result = $this->model->validator();

        $this->assertEquals(true, $result);
    }

    // バリデーションに失敗したらオブジェクトにエラーを返すテスト
    public function testSetsErrorsOnObjectIfValidationFails()
    {
        Validator::shouldReceive('make')->once()->andReturn(
            \Mockery::mock(['passes' => false, 'message' => 'message'])
        );

        $result = $this->model->validator();

        $this->assertEquals(false, $result);
        $this->assertEquals('message', $this->model->errors);
    }
}

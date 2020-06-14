<?php

namespace Tests\Unit;

use App\Task;
use Mockery\Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    protected $tasks;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tasks = factory(Task::class)->create();
    }

    public function testHasRegisteredTasks(): void
    {
        $this->assertDatabaseHas('tasks', [
            'task_name' => $this->tasks->todo_name
        ]);
    }

    public function testCanDeleteTasks(): void
    {
        try {
            $this->tasks->delete();
        } catch (\Exception $e) {
            throw new Exception($e);
        }

        $this->assertDatabaseMissing('tasks', [
            'task_name' => $this->tasks->todo_name
        ]);
    }
}

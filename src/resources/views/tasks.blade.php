@extends('layouts.app')

@section('content')
    <div class="container">
        @if (!empty($user_tasks))
            <div class="panel panel-default">
                <div class="panel-heading">
                    Current Tasks
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                        <th>Task</th>
                        <th>&nbsp;</th>
                        </thead>

                        <tbody>
                        @foreach ($user_tasks as $user_task)
                            <tr>
                                <td class="table-text">
                                    <div>・{{ $user_task->task_name }}</div>
                                </td>

                                <td>
                                    <!-- TODO: Delete Button -->
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <div class="panel-body">
            <form action="{{ route('tasks_store') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="task-name" class="col-sm-3 control-label">Task</label>

                    <div class="col-sm-6">
                        <input type="text" name="task_name" id="task_name" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button name="task_store" id="task_store" type="submit" class="btn btn-default">
                            <i class="fa fa-plus"></i> Add Task
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

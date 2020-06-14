<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    public function store(Request $request)
    {
        $task_name = $request->input('task_name');

        Task::create([
            'user_id' => Auth::id(),
            'task_name' => $task_name
        ]);

        return redirect('/tasks');
    }

    public function show()
    {
        $user_id = Auth::id();
        $user_tasks = DB::table('tasks')
            ->join('users', 'users.id', '=', 'tasks.user_id')
            ->whereIn('tasks.user_id', [$user_id])
            ->get();

        return view('tasks', ['user_tasks' => $user_tasks]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

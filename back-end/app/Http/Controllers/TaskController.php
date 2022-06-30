<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tasks = DB::table('tasks', 't')
            ->join('users AS u', 'u.id', '=', 't.assigned_to')
            ->join('task_statuses AS ts', 'ts.id', '=', 't.status_id')
            ->select(['t.*', 'ts.name AS status', 'u.name AS assignee'])
            ->get();

        $users = DB::table('users', 'u')
            ->select(['u.id', 'u.name'])
            ->get();

        $statuses = DB::table('task_statuses', 'ts')
            ->get();

        $response = compact('statuses', 'users', 'tasks');

        return response(json_encode($response));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'assigned_to' => 'required|integer',
            'status_id' => 'required|integer',
            'summary' => 'required',
            'due_date' => 'required',
            'description' => 'required'
        ]);

        $next_key = DB::table('tasks')
            ->max('key') + 1;

        $validated['key'] = $next_key;

        Task::insert($validated);
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
        $validated = $request->validate([
            'assigned_to' => 'required|integer',
            'status_id' => 'required|integer',
            'summary' => 'required',
            'due_date' => 'required',
            'description' => 'required'
        ]);

        $task = Task::findOrFail($id);
        $task->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }
}
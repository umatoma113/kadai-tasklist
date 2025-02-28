<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
        }

        return view('tasks.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task = new Task;

        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|string|max:10',
            'content' => 'required|max:255',
        ]);

        $task = new Task;
        $task->status = $request->status;
        $task->content = $request->content;
        $task->user_id = Auth::id();
        $task->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|string|max:10',
            'content' => 'required|max:255',
        ]);

        $task = Task::findOrFail($id);
        $task->status = $request->status;
        $task->content = $request->content;
        $task->user_id = Auth::id();
        $task->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/');
    }
}

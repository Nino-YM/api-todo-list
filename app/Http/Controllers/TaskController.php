<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function show($id)
    {
        return Task::find($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id_project',
            'user_id' => 'required|exists:users,id_user',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|string|max:50',
            'document' => 'nullable|string|max:255',
        ]);

        return Task::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());

        return $task;
    }

    public function destroy($id)
    {
        Task::find($id)->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}

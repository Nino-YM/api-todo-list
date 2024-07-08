<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::all();
    }

    public function show($id)
    {
        return Project::find($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id_user',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        return Project::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());

        return $project;
    }

    public function destroy($id)
    {
        Project::find($id)->delete();

        return response()->json(['message' => 'Project deleted successfully']);
    }
}

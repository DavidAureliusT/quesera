<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, String $project_key)
    {
        $validated = $request->validate([
            'summary' => ['required', 'max:120']
        ]);

        $project = Project::where('key', $project_key)->first();

        $project->tasks()->save(new Task([
            'key' => $project->key . '-' . $project->tasks()->count() + 1,
            'summary' => $validated['summary'],
            'status_id' => $project->workflows()->first()->id
        ]));

        return to_route(
            route: 'projects.show',
            parameters: ['project_key' => $project->key]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $project_key, String $task_key)
    {
        Task::where('key', $task_key)
            ->update($request->validate([
                'summary' => ['sometimes', 'required'],
                'point' => ['sometimes', 'required'],
                'status_id' => ['sometimes', 'required'],
            ]));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}

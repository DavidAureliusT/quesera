<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class TaskController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, String $project_key, String $status_id = '')
    {
        $validated = $request->validate([
            'summary' => ['required', 'max:120'],
        ]);

        $project = Project::where('key', $project_key)->first();

        $project->tasks()->save(new Task([
            'key' => $project->key . '-' . $project->tasks()->count() + 1,
            'summary' => $validated['summary'],
            'status_id' => $status_id != '' ? $status_id : $project->workflows()->first()->id
        ]));

        return to_route(
            route: 'projects.show',
            parameters: ['project_key' => $project->key]
        );
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

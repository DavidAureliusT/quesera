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
    public function store(Request $request, String $project_key)
    {
        $validated = $request->validate([
            'summary' => ['required', 'max:120']
        ]);

        // Use a transaction to ensure the entire operation is atomic
        $task = DB::transaction(function () use ($validated, $project_key) {
            // Use firstOrFail to automatically handle 404 if project not found
            $project = Project::where('key', $project_key)->firstOrFail();

            // Get the first workflow or fail gracefully
            $workflow = $project->workflows()->first();
            if (!$workflow) {
                // Or handle this error as you see fit
                throw new ModelNotFoundException('The project does not have a default workflow.');
            }

            // --- Correctly calculate counts before creating the task ---

            // Fix operator precedence with parentheses
            // Use a DB query for efficiency
            $next_task_number = $project->tasks()->count() + 1;
            $task_key = $project->key . '-' . $next_task_number;

            // Use a DB query instead of lazy-loading the whole collection
            $kanban_order = $project->tasks()
                ->where('status_id', $workflow->id)
                ->count() + 1;

            // Create and save the new task
            return $project->tasks()->create([
                'key'          => $task_key,
                'summary'      => $validated['summary'],
                'status_id'    => $workflow->id,
                'kanban_order' => $kanban_order,
            ]);
        });

        return to_route(
            route: 'projects.show',
            parameters: ['project_key' => $project_key]
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

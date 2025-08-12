<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Role;
use App\Models\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Main');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required'],
            'name' => ['required', 'max:120'],
            'key' => ['required', 'unique:projects'],
        ]);

        $project = Project::create($validated);

        if ($validated['type'] == 'basic') {
            $project->workflows()->saveMany([
                new Workflow([
                    'name' => 'To do',
                    'category' => 'To do',
                ]),
                new Workflow([
                    'name' => 'In Progress',
                    'category' => 'In Progress',
                ]),
                new Workflow([
                    'name' => 'Done',
                    'category' => 'Done',
                ]),
            ]);
        } else if ($validated['type'] == 'scrum') {
            $project->workflows()->saveMany([
                new Workflow([
                    'name' => 'Backlog',
                    'category' => 'To do'
                ]),
                new Workflow([
                    'name' => 'Sprint',
                    'category' => 'In Progress'
                ]),
                new Workflow([
                    'name' => 'In Progress',
                    'category' => 'In Progress'
                ]),
                new Workflow([
                    'name' => 'Review',
                    'category' => 'In Progress'
                ]),
                new Workflow([
                    'name' => 'Done',
                    'category' => 'Done'
                ]),
            ]);
        }
        $project->accesses()->create([
            'role_id' => Role::ADMINISTRATOR_ID,
            'user_id' => Auth::user()->id
        ]);

        return to_route(
            route: 'projects.show',
            parameters: ['project_key' => $project->key]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(String $project_key)
    {
        return Inertia::render('Main', [
            'project' => Project::where('key', $project_key)->first()->toResource(),
            'bytes' => str()->random(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $project_key)
    {
        Project::where('key', $project_key)->update(
            $request->validate([
                'name' => ['required', 'max:120'],
            ])
        );

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}

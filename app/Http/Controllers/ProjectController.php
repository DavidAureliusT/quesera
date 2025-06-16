<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Workflow;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Projects', [
            'projects' => Project::all()->select(['id', 'name', 'key', 'type'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('projects/Create');
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
                new Workflow(['name' => 'To do']),
                new Workflow(['name' => 'In Progress']),
                new Workflow(['name' => 'Done']),
            ]);
        } else if ($validated['type'] == 'scrum') {
            $project->workflows()->saveMany([
                new Workflow(['name' => 'Backlog']),
                new Workflow(['name' => 'Sprint']),
                new Workflow(['name' => 'In Progress']),
                new Workflow(['name' => 'Review']),
                new Workflow(['name' => 'Done']),
            ]);
        }

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
        return Inertia::render('projects/Show', [
            'project' => Project::where('key', $project_key)->first()->toResource(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SandboxController extends Controller
{
    public function index()
    {
        return Inertia::render('Sandbox2', [
            'project' => Project::find(1)->toResource(),
        ]);
    }

    public function linking(String $project_key)
    {
        $project = Project::where('key', $project_key)->first();

        foreach ($project->workflows as $workflow) {
            for ($i = 0; $i < count($workflow->tasks); $i++) {
                $workflow->tasks[$i]->is_head = $i == 0;
                if ($i < count($workflow->tasks) - 1) {
                    $workflow->tasks[$i]->next_id = $workflow->tasks[$i + 1]->id;
                }
                $workflow->tasks[$i]->save();
            }
        }
        $project->save();

        return redirect()->back();
    }
}

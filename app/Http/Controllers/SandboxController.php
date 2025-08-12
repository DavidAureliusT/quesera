<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SandboxController extends Controller
{
    public function index()
    {
        return Inertia::render('Sandbox', [
            'project' => Project::find(1)->toResource(),
        ]);
    }
}

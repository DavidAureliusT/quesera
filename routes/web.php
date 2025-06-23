<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/day-1', fn() => Inertia::render('DayOne'));

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', fn() => Inertia::render('Compas', [
        //
    ]))->name('home');
    Route::get('/dashboard', fn() => Inertia::render('Dashboard'))->name('dashboard');
    Route::resources(
        resources: [
            'projects' => ProjectController::class,
            'projects.tasks' => TaskController::class,
        ],
        options: [
            'parameters' => [
                'projects' => 'project_key',
                'tasks' => 'task_key'
            ]
        ]
    );
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';

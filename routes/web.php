<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', fn() => to_route('projects.index'))->name('home');
    Route::get('/dashboard', fn() => Inertia\Inertia::render('Dashboard'))->name('dashboard');
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

Route::get('/server', fn() => $_SERVER);
Route::get('/globals', fn() => $GLOBALS);
Route::get('/tz', fn() => "TIMEZONE");

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';

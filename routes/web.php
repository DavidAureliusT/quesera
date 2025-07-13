<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('/server', fn() => $_SERVER);
Route::get('/globals', fn() => $GLOBALS);
Route::get('/tz', fn() => "TIMEZONE");

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', fn() => to_route('projects.index'))->name('home');
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

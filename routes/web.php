<?php

use App\Http\Controllers\KanbanController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', fn() => to_route('projects.index'))->name('home');

    Route::resource('projects', ProjectController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy'])
        ->parameters(['projects' => 'project_key']);

    Route::resource('projects.tasks', TaskController::class)
        ->only(['store', 'update', 'destroy'])
        ->parameters([
            'projects' => 'project_key',
            'tasks' => 'task_key'
        ]);

    Route::resource('projects.kanban', KanbanController::class)
        ->only(['update'])
        ->parameters(['projects' => 'project_key', 'kanban' => null]);
});

Route::get('/server', fn() => $_SERVER);
Route::get('/globals', fn() => $GLOBALS);
Route::get('/tz', fn() => "TIMEZONE");

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';

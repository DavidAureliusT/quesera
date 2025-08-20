<?php

use App\Http\Controllers\KanbanController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SandboxController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', fn() => to_route('projects.index'))->name('home');

    Route::resource('projects', ProjectController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy'])
        ->parameters(['projects' => 'project_key']);

    Route::controller(TaskController::class)->group(function () {
        Route::post('/projects/{project_key}/tasks/{status_id?}', 'store')->name('projects.tasks.store');
        Route::put('/projects/{project_key}/tasks/{task_key}', 'update')->name('projects.tasks.update');
    });

    Route::controller(SandboxController::class)->group(function () {
        Route::get('/sandbox', 'index')->name('sandbox');
        Route::get('/sandbox/linking/{project_key}', 'linking')->name('sandbox.linking');
    });
});

Route::get('/server', fn() => $_SERVER);
Route::get('/globals', fn() => $GLOBALS);
Route::get('/tz', fn() => "TIMEZONE");

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';

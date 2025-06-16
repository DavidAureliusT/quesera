<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::resource('projects', ProjectController::class)
    ->only(['index', 'create', 'store', 'show'])
    ->parameters(['projects' => 'project_key']);

Route::resource('projects.tasks', TaskController::class)
    ->only(['index', 'create', 'store', 'show'])
    ->parameters([
        'projects' => 'project_key',
        'tasks' => 'task_key'
    ]);

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';

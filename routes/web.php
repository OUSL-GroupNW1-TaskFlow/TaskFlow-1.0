<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemAdmin\DashboardController as SystemDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Agent\DashboardController as AgentDashboard;
use App\Http\Controllers\Agent\ProjectController;
use App\Http\Controllers\Agent\KanbanController;
use App\Http\Controllers\Agent\TaskController;
use App\Http\Controllers\Agent\TaskFileController;
use App\Http\Controllers\Admin\TaskCommentController;
use App\Http\Controllers\Admin\AdminAgentProjectController;
use App\Http\Controllers\Admin\AdminKanbanController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Role-Based Dashboards
|--------------------------------------------------------------------------
*/


Route::middleware(['auth', 'role:system_admin'])
    ->prefix('system')
    ->name('system.')
    ->group(function () {

        Route::get('/dashboard', [SystemDashboard::class, 'index'])
            ->name('dashboard');
    });

Route::middleware(['auth', 'role:admin|system_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])
            ->name('dashboard');

        // User Management (Admin + System Admin)
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])
            ->name('users.index');

        Route::get(
            '/users/{user}/edit',
            [\App\Http\Controllers\Admin\UserController::class, 'edit']
        )->name('users.edit');

        Route::put(
            '/users/{user}',
            [\App\Http\Controllers\Admin\UserController::class, 'update']
        )->name('users.update');

        Route::delete(
            '/users/{user}',
            [\App\Http\Controllers\Admin\UserController::class, 'destroy']
        )->name('users.destroy');

        Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])
            ->name('users.store');

        //Admin → Agent Projects
        Route::get('/agents/{agent}/projects', [AdminAgentProjectController::class, 'index'])
            ->name('agents.projects');

        // Project Approval/Decline
        Route::post('/projects/{project}/approve', [\App\Http\Controllers\Admin\AdminProjectController::class, 'approve'])
            ->name('projects.approve');

        Route::post('/projects/{project}/decline', [\App\Http\Controllers\Admin\AdminProjectController::class, 'decline'])
            ->name('projects.decline');

        // Admin Kanban 
        // Task Comments Management
        Route::post(
            '/tasks/{task}/comments',
            [TaskCommentController::class, 'store']
        )->name('tasks.comments.store');
        Route::get(
            '/projects/{project}/kanban',
            [AdminKanbanController::class, 'show']
        )->name('projects.kanban');
        Route::delete(
            '/tasks/comments/{comment}',
            [TaskCommentController::class, 'destroy']
        )->name('tasks.comments.destroy');
    });

Route::middleware(['auth', 'role:agent'])
    ->prefix('agent')
    ->name('agent.')
    ->group(function () {

        Route::get('/dashboard', [AgentDashboard::class, 'index'])
            ->name('dashboard');

        // Project Management (Agent only)
        Route::get('/projects', [ProjectController::class, 'index'])
            ->name('projects.index');

        Route::post('/projects', [ProjectController::class, 'store'])
            ->name('projects.store');

        Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])
            ->name('projects.edit');

        Route::put('/projects/{project}', [ProjectController::class, 'update'])
            ->name('projects.update');

        Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])
            ->name('projects.destroy');

        // Kanban Board for Tasks within a Project
        Route::get('/projects/{project}/kanban', [KanbanController::class, 'show'])
            ->name('projects.kanban');


        // Task Management within Kanban Board
        Route::post('/projects/{project}/tasks', [TaskController::class, 'store'])
            ->name('tasks.store');

        Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
            ->name('tasks.destroy');

        Route::patch('/tasks/{task}/move', [TaskController::class, 'move'])
            ->name('tasks.move');

        Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
        Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
        Route::delete('/tasks/{task}/file', [TaskController::class, 'deleteFile'])
            ->name('tasks.file.delete');
        Route::delete('/task-files/{file}', [TaskFileController::class, 'destroy'])
            ->name('task-files.destroy');
        Route::delete('/tasks/{task}/files', [TaskFileController::class, 'destroyAll'])
            ->name('agent.task-files.destroyAll');
        Route::get('/agent/task-files/{file}/download', [TaskFileController::class, 'download'])
            ->name('agent.task-files.download');
    });

/*
|--------------------------------------------------------------------------
| User Settings / Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

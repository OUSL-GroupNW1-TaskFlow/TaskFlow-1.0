<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemAdmin\DashboardController as SystemDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Agent\DashboardController as AgentDashboard;

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

        Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])
            ->name('users.store');
    });

Route::middleware(['auth', 'role:agent'])
    ->prefix('agent')
    ->name('agent.')
    ->group(function () {

        Route::get('/dashboard', [AgentDashboard::class, 'index'])
            ->name('dashboard');
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

require __DIR__.'/auth.php';
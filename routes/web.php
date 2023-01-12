<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Gate\RoleController;
use App\Http\Controllers\Gate\PermissionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('table', [AdminDashboardController::class, 'table'])->name('dashboard.table');
    
    Route::prefix('gate')->name('gate.')->group(function (){
      Route::prefix('role')->name('role.')->group(function(){
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/store', [RoleController::class, 'store'])->name('store');
        Route::delete('/{id}/delete', [RoleController::class, 'destroy'])->name('delete');
        Route::post('/{id}/delete', [RoleController::class, 'update'])->name('edit');
      });
      
      Route::prefix('permission')->name('permission.')->group(function() {
        Route::get('/', [PermissionController::class, 'index'])->name('index');
      });
    });
});

Route::prefix('gate')->name('gate.')->group(function(){
  Route::prefix('permission')->name('permission.')->group(function(){
    Route::get('/', [PermissionController::class, 'index'])->name('index');
    Route::post('/store', [PermissionController::class, 'store'])->name('store');
    Route::delete('/{id}/delete', [PermissionController::class, 'destroy'])->name('delete');
    Route::post('/{id}/delete', [PermissionController::class, 'update'])->name('update');
  });
});

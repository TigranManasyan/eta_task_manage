<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

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
    return view('welcome');
});


Auth::routes();


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/', [\App\Http\Controllers\Admin\IndexController::class, "index"])->name('admin.dash');
    Route::get("users", [UserController::class, "index"])->name('admin.user.index');
    Route::get("users/create", [UserController::class, "create"])->name('admin.user.create');
    Route::get("users/{id}/edit", [UserController::class, "edit"])->name('admin.user.edit');
    Route::get("users/{id}/delete", [UserController::class, "destroy"])->name('admin.user.delete');
    Route::post("users/store", [UserController::class, "store"])->name('admin.user.store');
    Route::post("users/update", [UserController::class, "update"])->name('admin.user.update');
});

Route::prefix('manager')->middleware(['auth', 'role:manager'])->group(function() {
    Route::get('/', [\App\Http\Controllers\Manager\IndexController::class, "index"])->name('manager.dash');
    Route::get("users", [\App\Http\Controllers\Manager\UserController::class, "index"])->name('manager.user.index');
    Route::get("users/create", [\App\Http\Controllers\Manager\UserController::class, "create"])->name('manager.user.create');
    Route::get("users/{id}/edit", [\App\Http\Controllers\Manager\UserController::class, "edit"])->name('manager.user.edit');
    Route::get("users/{id}/delete", [\App\Http\Controllers\Manager\UserController::class, "destroy"])->name('manager.user.delete');
    Route::post("users/store", [\App\Http\Controllers\Manager\UserController::class, "store"])->name('manager.user.store');
    Route::post("users/update", [\App\Http\Controllers\Manager\UserController::class, "update"])->name('manager.user.update');

    //Tasks

    Route::get('tasks', [\App\Http\Controllers\Manager\TaskController::class, "index"])->name('manager.task.index');
    Route::get('tasks/create', [\App\Http\Controllers\Manager\TaskController::class, "create"])->name('manager.task.create');
    Route::get('tasks/{id}', [\App\Http\Controllers\Manager\TaskController::class, "show"])->name('manager.task.show');
    Route::get('tasks/edit/{id}', [\App\Http\Controllers\Manager\TaskController::class, "edit"])->name('manager.task.edit');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

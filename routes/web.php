<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TasksColumnsController;
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

Route::get('/users', [\App\Http\Controllers\UsersController::class, 'index'])->middleware(['auth', 'verified'])->name('users.index');
Route::get('/users/{id}', [\App\Http\Controllers\UsersController::class, 'show'])->middleware(['auth', 'verified'])->name('users.show');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [CategoryController::class, 'index'])->name('dashboard');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/task-columns', [TasksColumnsController::class, 'store'])->name('task-columns.store');
    Route::put('/task-columns', [TasksColumnsController::class, 'update'])->name('task-columns.update');
    Route::delete('/task-columns/{taskColumn}', [TasksColumnsController::class, 'destroy'])->name('task-columns.destroy');

    Route::post('/task', [TaskController::class, 'store'])->name('task.store');
    Route::get('/task', [TaskController::class, 'show'])->name('task.show');

    Route::post('/add-friend/{user}', [FriendshipController::class, 'addFriend'])->name('add-friend');
    Route::post('/remove-friend/{user}', [FriendshipController::class, 'removeFriend'])->name('remove-friend');
});

require __DIR__.'/auth.php';

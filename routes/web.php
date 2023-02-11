<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('users',[UserController::class,'users'])->name('users.list');
    Route::get('users/create',[UserController::class,'create'])->name('users.create');
    Route::post('users/store',[UserController::class,'store'])->name('users.store');
    Route::post('users/activation',[UserController::class,'activation'])->name('users.activation');
    Route::resource('projects',ProjectsController::class);
    Route::resource('tasks',TasksController::class)->except('create');
    Route::get('tasks/create/{project}',[TasksController::class,'create'])->name('tasks.create');
    Route::post('starttimer',[TasksController::class,'starttimer'])->name('starttimer');
    Route::post('pausetimer',[TasksController::class,'pausetimer'])->name('pausetimer');
    Route::post('stoptimer',[TasksController::class,'stoptimer'])->name('stoptimer');
    Route::get('tasks/{id}/report',[TasksController::class,'report'])->name('tasks.report');
});

require __DIR__.'/auth.php';

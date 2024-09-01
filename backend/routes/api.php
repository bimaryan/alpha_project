<?php

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('register', [RegisterController::class, 'store'])->name('register');
Route::post('login', [LoginController::class, 'store'])->name('login');

Route::middleware(['auth:sanctum', 'role:1'])->group(function () {
    Route::get('task', [TaskController::class, 'index'])->name('tasks');
    Route::post('task/create', [TaskController::class, 'store'])->name('tasks.create');
    Route::delete('task/delete/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::get('task/update/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::put('task/update/{id}', [TaskController::class, 'update_store'])->name('tasks.update.store');
});
Route::middleware(['auth:sanctum', 'role:2'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('index');
});

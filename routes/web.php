<?php

use App\Http\Controllers\TaskController;
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

// User
Route::get('/',[UserController::class,'index'])->name('register');
Route::get('login',[UserController::class,'loginpage'])->name('login');
Route::post('register',[UserController::class,'register'])->name('register.post');
Route::post('login',[UserController::class,'login'])->name('login.post');
Route::get('dashboard',[UserController::class,'dashboard'])->middleware('auth');
Route::get('addtask',[UserController::class,'addtask'])->middleware('auth');
Route::get('logout',[UserController::class,'logout'])->name('logout');

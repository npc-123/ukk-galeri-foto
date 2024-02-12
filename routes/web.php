<?php

use App\Livewire\AuthController;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/login', [AuthController::class, 'index_login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'index_register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [Home::class, 'render']); 
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');   
});
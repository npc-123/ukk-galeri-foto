<?php

use App\Livewire\Album;
use App\Livewire\AuthController;
use App\Livewire\EditPost;
use App\Livewire\Profile;
use App\Livewire\Home;
use App\Livewire\NewPost;
use App\Livewire\Notification;
use App\Livewire\Post;
use App\Livewire\Search;
use App\Livewire\Settings;
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
    Route::get('/', Home::class); 
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');   
    Route::get('/settings', Settings::class)->name('settings');   
    Route::get('/new', NewPost::class)->name('new-post');
    Route::get('/search', Search::class)->name('search');
    Route::get('/notification', Notification::class)->name('notification');
    Route::get('/p/{slug}', Post::class)->name('post');
    Route::get('/p/{slug}/edit', EditPost::class)->name('post-edit');
    Route::get('/{user}', Profile::class)->name('gallery');
    Route::get('/{user}/{page}', Profile::class);
    Route::get('/{user}/album/{album}', Album::class);
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tag\TagController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\User\UserView;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Dashboard\DashboardView;
use App\Http\Controllers\Dashboard\DashboardController;

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

Route::group(['middleware' => ['guest']], function() {

    Route::get('/', [UserView::class, 'showAuth'])->name('index');

    Route::get('/auth', [UserView::class, 'showAuth'])->name('auth');

    Route::get('/register', [UserView::class, 'showRegistration'])->name('registration');

});

Route::group(['middleware' => ['auth']], function() {

    Route::get('/dashboard',[DashboardView::class, 'show'])->name('dashboard');

    Route::get('/cache/flush',[DashboardController::class, 'flush'])->name('cache.flush');

    Route::get('/logout', [UserView::class, 'showLogoutData'])->name('auth');

    Route::resources([
        'tags' => TagController::class,
        'posts' => PostController::class,
    ]);
    
});

Route::post('/login', [UserController::class, 'login']);

Route::post('/register', [UserController::class, 'create']);
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialMediaController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('user')->name('user.')->group(function(){
  
    Route::middleware(['guest:web', 'PreventBackHistory'])->group(function(){
          Route::view('/login','dashboard.user.login')->name('login');
          Route::view('/register','dashboard.user.register')->name('register');
          Route::post('/create', [UserController::class, 'create'])->name('create');
          Route::post('/check', [UserController::class, 'check'])->name('check');
          // social media login routes
          Route::get('/auth/{provider}', [SocialMediaController::class, 'redirectToProvider'])->where('provider','facebook|google');
          Route::get('/auth/{provider}/callback', [SocialMediaController::class, 'handleProviderCallback'])->where('provider','facebook|google');

    });

    Route::middleware(['auth:web', 'PreventBackHistory'])->group(function(){
          Route::view('/home','dashboard.user.home')->name('home');
    });

});

Route::prefix('admin')->name('admin.')->group(function(){
  
    Route::middleware(['guest:admin', 'PreventBackHistory'])->group(function(){
          Route::view('/login','dashboard.admin.login')->name('login');
          Route::post('/check', [AdminController::class, 'check'])->name('check');

    });

    Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function(){
          Route::view('/home','dashboard.admin.home')->name('home');
    });

});
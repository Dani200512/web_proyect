<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\MultimediaController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('web')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
        Route::post('/register', [RegisterController::class, 'register'])->name('register');
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


    Route::get('/home', function () {
        return view('home');
    })->middleware('auth')->name('home');


    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });


    Route::middleware(['auth'])->group(function () {
        Route::resource('posts', PostController::class);
        Route::get('/profile/{profile}/posts', [PostController::class, 'viewProfilePosts'])->name('profile.posts');
    });



Route::middleware(['auth'])->group(function () {
    Route::resource('job-offers', JobOfferController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('multimedia', MultimediaController::class);
});
